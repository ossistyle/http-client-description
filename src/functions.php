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
