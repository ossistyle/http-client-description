<?php

namespace Vws;

use GuzzleHttp\Client;

/**
 * Software Developer Kit
 *
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

    /**
     * Create an endpoint prefix name from a namespace.
     *
     * @param string $name Namespace name
     *
     * @return string
     */
    public static function getEndpointPrefix($name)
    {
        $name = strtolower($name);

        return isset(self::$aliases[$name]) ? self::$aliases[$name] : $name;
    }

    public function createClient($name, array $args = [])
    {
        // Merge provided args with stored args
        if (isset($this->args[$name])) {
            $args += $this->args[$name];
        }

        $args += $this->args;

        if (!isset($args['service'])) {
            $args['service'] = self::getEndpointPrefix($name);
        }

        $name = ucfirst(strtolower($name));

        $client = "Vws\\{$name}\\{$name}Client";

        if (!class_exists($client)) {
            $client = 'Vws\\VwsClient';
        }

        return new $client($args);
    }
}
