<?php
namespace Vws;

/**
 * Retrieves data for a service from the SDK's service manifest file.
 *
 * Manifest data is stored statically, so it does not need to be loaded more
 * than once per process. The JSON data is also cached in opcache.
 *
 * @param string $service Case-insensitive namespace or endpoint prefix of the
 *                        service for which you are retrieving manifest data.
 *
 * @return array
 * @throws \InvalidArgumentException if the service is not supported.
 */
function manifest($service = null)
{
    // Load the manifest and create aliases for lowercased namespaces
    static $manifest = [];
    static $aliases = [];
    if (empty($manifest)) {
        $manifest = load_compiled_json(__DIR__ . '/ressources/manifest.json');
        foreach ($manifest as $endpoint => $info) {
            $alias = strtolower($info['namespace']);
            if ($alias !== $endpoint) {
                $aliases[$alias] = $endpoint;
            }
        }
    }

    // If no service specified, then return the whole manifest.
    if ($service === null) {
        return $manifest;
    }

    // Look up the service's info in the manifest data.
    $service = strtolower($service);
    if (isset($manifest[$service])) {
        return $manifest[$service] + ['endpoint' => $service];
    } elseif (isset($aliases[$service])) {
        return manifest($aliases[$service]);
    } else {
        throw new \InvalidArgumentException(
            "The service \"{$service}\" is not provided by the VWS SDK for PHP."
        );
    }
}

/**
 * Loads a compiled JSON file from a PHP file.
 *
 * If the JSON file has not been cached to disk as a PHP file, it will be loaded
 * from the JSON source file and returned.
 *
 * @param string $path Path to the JSON file on disk
 *
 * @return mixed Returns the JSON decoded data. Note that JSON objects are
 *     decoded as associative arrays.
 */
function load_compiled_json($path)
{
    if ($compiled = @include("$path.php")) {
        return $compiled;
    }

    if (!file_exists($path)) {
        throw new \InvalidArgumentException(
            sprintf("File not found: %s", $path)
        );
    }

    return json_decode(file_get_contents($path), true);
}

/**
 * Iterates over the files in a directory and works with custom wrappers.
 *
 * @param string   $path Path to open (e.g., "s3://foo/bar").
 * @param resource $context Stream wrapper context.
 *
 * @return \Generator Yields relative filename strings.
 */
function dir_iterator($path, $context = null)
{
    $dh = $context ? opendir($path, $context) : opendir($path);
    if (!$dh) {
        throw new \InvalidArgumentException('File not found: ' . $path);
    }
    while (($file = readdir($dh)) !== false) {
        yield $file;
    }
    closedir($dh);
}

/**
 * Returns a recursive directory iterator that yields absolute filenames.
 *
 * This iterator is not broken like PHP's built-in DirectoryIterator (which
 * will read the first file from a stream wrapper, then rewind, then read
 * it again).
 *
 * @param string   $path    Path to traverse (e.g., s3://bucket/key, /tmp)
 * @param resource $context Stream context options.
 *
 * @return \Generator Yields absolute filenames.
 */
function recursive_dir_iterator($path, $context = null)
{
    $invalid = ['.' => true, '..' => true];
    $pathLen = strlen($path) + 1;
    $iterator = dir_iterator($path, $context);
    $queue = [];
    do {
        while ($iterator->valid()) {
            $file = $iterator->current();
            $iterator->next();
            if (isset($invalid[basename($file)])) {
                continue;
            }
            $fullPath = "{$path}/{$file}";
            yield $fullPath;
            if (is_dir($fullPath)) {
                $queue[] = $iterator;
                $iterator = map(
                    dir_iterator($fullPath, $context),
                    function ($file) use ($fullPath, $pathLen) {
                        return substr("{$fullPath}/{$file}", $pathLen);
                    }
                );
                continue;
            }
        }
        $iterator = array_pop($queue);
    } while ($iterator);
}

/**
 * Applies a map function $f to each value in a collection.
 *
 * @param mixed    $iterable Iterable sequence of data.
 * @param callable $f        Map function to apply.
 *
 * @return \Generator
 */
function map($iterable, callable $f)
{
    foreach ($iterable as $value) {
        yield $f($value);
    }
}

/**
 * Debug function used to describe the provided value type and class.
 *
 * @param mixed $input
 *
 * @return string Returns a string containing the type of the variable and
 *                if a class is provided, the class name.
 */
function describe_type($input)
{
    switch (gettype($input)) {
        case 'object':
            return 'object(' . get_class($input) . ')';
        case 'array':
            return 'array(' . count($input) . ')';
        default:
            ob_start();
            var_dump($input);
            // normalize float vs double
            return str_replace('double(', 'float(', rtrim(ob_get_clean()));
    }
}
