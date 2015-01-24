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

    /**
     * Constructs a new VDK object with an associative array of default
     * client settings.
     *
     * @param array $args
     *
     * @throws \InvalidArgumentException
     * @see Via\Vdk::getClient for a list of available options.
     */
    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    public function __call($name, array $args = [])
    {
        if (strpos($name, 'get') === 0) {
            return $this->getClient(
                substr($name, 3),
                isset($args[0]) ? $args[0] : []
            );
        }

        throw new \BadMethodCallException("Unknown method: {$name}.");
    }

    public function getClient($name, array $args = [])
    {
        // Normalize service name to lower case
        $name = strtolower($name);

        // Merge provided args with stored args
        if (isset($this->args[$name])) {
            $args += $this->args[$name];
        }
        $args += $this->args;

        // Set the service name and determine if it is linked to a known class
        $args['service'] = $name;
        $args['class_name'] = false;
        $factoryName = 'Vws\\ClientFactory';

        if (isset(self::$services[$name])) {
            $args['class_name'] = self::$services[$name];
            $check = "Vws\\{$args['class_name']}\\{$args['class_name']}Factory";
            if (class_exists($check)) {
                $factoryName = $check;
            }
        }
        return (new $factoryName())->create($args);
    }
}
