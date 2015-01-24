<?php

namespace Vws;

use GuzzleHttp\Command\AbstractClient;
use GuzzleHttp\Command\CommandTransaction;

class VwsClient extends AbstractClient implements VwsClientInterface
{
    /** @var array Default command options */
    private $defaults;

    /** @var string */
    private $region;

    /** @var string */
    private $endpoint;

    /** @var ServiceModel */
    private $api;

    /** @var callable */
    private $serializer;

    public function __construct(array $config)
    {
        static $required = ['api', 'credentials', 'client', 'serializer'];

        foreach ($required as $r) {
            if (!isset($config[$r])) {
                throw new \InvalidArgumentException("$r is a required option");
            }
        }

        $this->serializer = $config['serializer'];
        $this->api = $config['api'];
        $this->credentials = $config['credentials'];
        $this->endpoint = $config['endpoint'];
        $this->region = isset($config['region']) ? $config['region'] : null;
        $this->defaults = isset($config['defaults']) ? $config['defaults'] : [];

        parent::__construct($config['client']);
    }

    public static function factory(array $config = [])
    {
        // Determine the service being called
        $class = get_called_class();
        $service = substr($class, strrpos($class, '\\') + 1, -6);

        // Create the client using the Sdk class
        return (new Vdk)->getClient($service, $config);
    }

    public function getCommand($name, array $args = [])
    {
        // Fail fast if the command cannot be found in the description.
        if (!isset($this->api['operations'][$name])) {
            $name = ucfirst($name);
            if (!isset($this->api['operations'][$name])) {
                throw new \InvalidArgumentException("Operation not found: $name");
            }
        }

        // Merge in default configuration options.
        $args += $this->getConfig('defaults');

        if (isset($args['@future'])) {
            $future = $args['@future'];
            unset($args['@future']);
        } else {
            $future = false;
        }

        return new Command($name, $args + $this->defaults, [
            'emitter' => clone $this->getEmitter(),
            'future' => $future
        ]);
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getApi()
    {
        return $this->api;
    }

    protected function serializeRequest(CommandTransaction $trans)
    {
        $fn = $this->serializer;
        return $fn($trans);
    }
}
