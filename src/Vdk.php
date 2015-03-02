<?php

namespace Vws;

use GuzzleHttp\Client;

/**
 * Via Developer Kit
 *
 */
class Vdk
{
    const VERSION = '0.0.0.1';

    /** @var array Arguments for creating clients */
    private $args;

    /**
     * Map of service lowercase names to service class names.
     *
     * @var array
     */
    private static $services = [
        'blackbox'          => 'Blackbox',
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
        // Merge provided args with stored args
        if (isset($this->args[$name])) {
            $args += $this->args[$name];
        }

        $args += $this->args;

        if (!isset($args['service'])) {
            $args['service'] = self::getEndpointPrefix($name);
        }

        $client = "Aws\\{$name}\\{$name}Client";

        if (!class_exists($client)) {
            $client = 'Aws\\AwsClient';
        }

        return new $client($args);
    }
}
