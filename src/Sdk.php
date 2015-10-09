<?php

namespace Vws;

use GuzzleHttp\Client;

/**
 * Software Developer Kit.
 */
class Sdk
{
    const VERSION = '0.0.0.1';

    /** @var array Arguments for creating clients */
    private $args;

    /**
     * Map of service lowercase names to service class names.
     *
     * @var array
     */
    private static $aliases = [
        //'blackbox'          => 'Blackbox',
    ];

    public function __construct(array $args = [])
    {
        $this->args = $args;

        if (!isset($args['client'])) {
            $this->args['client'] = static function () {
                static $handler;
                if (!$handler) {
                    $handler = Client::getDefaultHandler();
                }

                return new Client(['handler' => $handler]);
            };
        }
    }

    public function __call($name, array $args = [])
    {
        if (strpos($name, 'create') === 0) {
            return $this->createClient(
                substr($name, 6),
                isset($args[0]) ? $args[0] : []
            );
        }

        throw new \BadMethodCallException("Unknown method: {$name}.");
    }

    public function createClient($name, array $args = [])
    {
        // Get information about the service from the manifest file.
        $service = manifest($name);
        $namespace = $service['namespace'];

        // Merge provided args with stored, service-specific args.
        if (isset($this->args[$namespace])) {
            $args += $this->args[$namespace];
        }

        // Provide the endpoint prefix in the args.
        if (!isset($args['service'])) {
            $args['service'] = $service['endpoint'];
        }

        // Instantiate the client class.
        $client = "Vws\\{$namespace}\\{$namespace}Client";
        return new $client($args + $this->args);
    }

    /**
     * Create an endpoint prefix name from a namespace.
     *
     * @param string $name Namespace name
     *
     * @return string
     */
    public static function getEndpointPrefix($name)
    {
        return manifest($name)['endpoint'];
    }
}
