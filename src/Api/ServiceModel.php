<?php
namespace Vws\Api;

/**
 * Represents a web service API model.
 */
class ServiceModel extends AbstractModel
{
    /** @var callable */
    private $apiProvider;

    /** @var string */
    private $serviceName;

    /** @var string */
    private $apiVersion;

    /** @var Operation[] */
    private $operations = [];

    /**
     * @param callable $apiProvider
     * @param string   $serviceName
     * @param string   $apiVersion
     * @param array    $options     Hash of options
     *
     * @internal param array $definition Service description
     */
    public function __construct(
        callable $apiProvider,
        $serviceName,
        $apiVersion,
        array $options = []
    ) {
        $definition = $apiProvider('api', $serviceName, $apiVersion);
        $this->apiProvider = $apiProvider;
        $this->serviceName = $serviceName;
        $this->apiVersion = $apiVersion;

        if (!isset($definition['operations'])) {
            $definition['operations'] = [];
        }

        if (!isset($definition['shapes'])) {
            $definition['shapes'] = [];
        }

        if (!isset($options['shape_map'])) {
            $options['shape_map'] = new ShapeMap($definition['shapes']);
        }

        parent::__construct($definition, $options['shape_map']);
    }

    /**
     * Creates a request serializer for the provided API object.
     *
     * @param Service $api      API that contains a protocol.
     * @param string  $endpoint Endpoint to send requests to.
     *
     * @return callable
     * @throws \UnexpectedValueException
     */
    public static function createSerializer(ServiceModel $api, $endpoint)
    {
        static $mapping = [
            'json'      => 'Vws\Api\Serializer\JsonRpcSerializer',
            'rest-json' => 'Vws\Api\Serializer\RestJsonSerializer',
        ];

        $proto = $api->getProtocol();

        if (isset($mapping[$proto])) {
            return new $mapping[$proto]($api, $endpoint);
        } else {
            throw new \UnexpectedValueException(
                'Unknown protocol: ' . $api->getProtocol()
            );
        }
    }

    /**
     * Creates an error parser for the given protocol.
     *
     * @param string $protocol Protocol to parse (e.g., query, json, etc.)
     *
     * @return callable
     * @throws \UnexpectedValueException
     */
    public static function createErrorParser($protocol)
    {
        static $mapping = [
            'json'      => 'Vws\Api\ErrorParser\JsonRpcErrorParser',
            'rest-json' => 'Vws\Api\ErrorParser\RestJsonErrorParser',
        ];

        if (!isset($mapping[$protocol])) {
            throw new \UnexpectedValueException("Unknown protocol: $protocol");
        }

        return new $mapping[$protocol]();
    }

    /**
     * Applies the listeners needed to parse client models.
     *
     * @param Service $api API to create a parser for
     * @return callable
     * @throws \UnexpectedValueException
     */
    public static function createParser(ServiceModel $api)
    {
        static $mapping = [
            'json'      => 'Vws\Api\Parser\JsonRpcParser',
            'rest-json' => 'Vws\Api\Parser\RestJsonParser',
        ];

        $proto = $api->getProtocol();
        if (isset($mapping[$proto])) {
            return new $mapping[$proto]($api);
        } else {
            throw new \UnexpectedValueException(
                'Unknown protocol: ' . $api->getProtocol()
            );
        }
    }

    /**
     * Get the full name of the service
     *
     * @return string
     */
    public function getServiceFullName()
    {
        return $this->getMetadata('serviceFullName');
    }

    /**
     * Get the API version of the service
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->getMetadata('apiVersion');
    }

    /**
     * Get the protocol used by the service.
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->getMetadata('protocol');
    }

    /**
     * Check if the description has a specific operation by name.
     *
     * @param string $name Operation to check by name
     *
     * @return bool
     */
    public function hasOperation($name)
    {
        return isset($this['operations'][$name]);
    }

    /**
     * Get an operation by name.
     *
     * @param string $name Operation to retrieve by name
     *
     * @return Operation
     * @throws \InvalidArgumentException If the operation is not found
     */
    public function getOperation($name)
    {
        if (!isset($this->operations[$name])) {
            if (!isset($this->definition['operations'][$name])) {
                throw new \InvalidArgumentException('Unknown operation: '
                    . $name);
            }

            $this->operations[$name] = new Operation(
                $this->definition['operations'][$name],
                $this->shapeMap
            );
        }

        return $this->operations[$name];
    }

    /**
     * Get all of the operations of the description.
     *
     * @return Operation[]
     */
    public function getOperations()
    {
        $result = [];
        foreach ($this->definition['operations'] as $name => $definition) {
            $result[$name] = $this->getOperation($name);
        }

        return $result;
    }

    /**
     * Get all of the service metadata or a specific metadata key value.
     *
     * @param string|null $key Key to retrieve or null to retrieve all metadata
     *
     * @return mixed Returns the result or null if the key is not found
     */
    public function getMetadata($key = null)
    {
        if (!$key) {
            if (!isset($this->definition['metadata'])) {
                $this->definition['metadata'] = [];
            }
            return $this['metadata'];
        }

        if (isset($this->definition['metadata'][$key])) {
            return $this->definition['metadata'][$key];
        }

        return null;
    }

}
