<?php
namespace Vws\Api;

/**
 * Represents a web service API model.
 */
class Service extends AbstractModel
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
     * @param callable $provider
     * @param string   $serviceName
     * @param string   $apiVersion
     *
     * @internal param array $definition Service description
     */
    public function __construct(callable $provider, $serviceName, $apiVersion)
    {
      static $defaults = [
          'operations' => [],
          'shapes'     => [],
          'metadata'   => []
      ], $defaultMeta = [
          'serviceFullName'  => null,
          'apiVersion'       => null,
          'endpointPrefix'   => null,
          'signingName'      => null,
          'signatureVersion' => null,
          'protocol'         => null
      ];

      $this->apiProvider = $provider;
      $this->serviceName = $serviceName;
      $this->apiVersion = $apiVersion;
      $definition = ApiProvider::resolve($provider, 'api', $serviceName, $apiVersion) + $defaults;
      $definition['metadata'] += $defaultMeta;
      parent::__construct($definition, new ShapeMap($definition['shapes']));
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
    public static function createSerializer(Service $api, $endpoint)
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
    public static function createParser(Service $api)
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
        return $this->definition['metadata']['serviceFullName'];
    }

    /**
     * Get the API version of the service
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->definition['metadata']['apiVersion'];
    }

    /**
     * Get the API version of the service
     *
     * @return string
     */
    public function getEndpointPrefix()
    {
        return $this->definition['metadata']['endpointPrefix'];
    }

    /**
     * Get the signing name used by the service.
     *
     * @return string
     */
    public function getSigningName()
    {
        return $this->definition['metadata']['signingName']
            ?: $this->definition['metadata']['endpointPrefix'];
    }

    /**
     * Get the default signature version of the service.
     *
     * Note: this method assumes "v4" when not specified in the model.
     *
     * @return string
     */
    public function getSignatureVersion()
    {
        return $this->definition['metadata']['signatureVersion'] ?: 'v4';
    }

    /**
     * Get the protocol used by the service.
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->definition['metadata']['protocol'];
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
                throw new \InvalidArgumentException("Unknown operation: $name");
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
            return $this['metadata'];
        } elseif (isset($this->definition['metadata'][$key])) {
            return $this->definition['metadata'][$key];
        }

        return null;
    }

    /**
     * Determines if the service has a paginator by name.
     *
     * @param string $name Name of the paginator.
     *
     * @return bool
     */
    public function hasPaginator($name)
    {
        if (!isset($this->paginators)) {
            $res = call_user_func(
                $this->apiProvider,
                'paginator',
                $this->serviceName,
                $this->apiVersion
            );
            $this->paginators = isset($res['pagination']) ? $res['pagination'] : [];
        }

        return isset($this->paginators[$name]);
    }

    /**
     * Retrieve a paginator by name.
     *
     * @param string $name Paginator to retrieve by name. This argument is
     *                     typically the operation name.
     * @return array
     * @throws \UnexpectedValueException if the paginator does not exist.
     */
    public function getPaginatorConfig($name)
    {
        static $defaults = [
            'input_token'  => null,
            'output_token' => null,
            'limit_key'    => null,
            'result_key'   => null,
            'more_results' => null,
        ];

        if ($this->hasPaginator($name)) {
            return $this->paginators[$name] + $defaults;
        }

        throw new \UnexpectedValueException(
            "There is no {$name} "
            . "paginator defined for the {$this->serviceName} service."
        );
    }
}
