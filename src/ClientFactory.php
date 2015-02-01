<?php

namespace Vws;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Ring\Core;
use Vws\Api\FilesystemApiProvider;
use Vws\Api\ServiceModel;
use Vws\Api\Validator;
use Vws\Credentials\Credentials;
use Vws\Credentials\CredentialsInterface;
use Vws\Credentials\NullCredentials;
use Vws\Credentials\Provider as CredentialProvider;
use Vws\Subscriber\Validation;
use Vws\Vdk;
use Vws\VwsClientInterface;

class ClientFactory
{
    private $requiredArguments = [
        'service',
        'scheme',
        'region',
        'version',
        'endpoint_provider',
        'api_provider',
    ];

    public static function getValidArguments()
    {
        return [
            'key'          => ['type' => 'deprecated'],
            'ssl.certificate_authority' => ['type' => 'deprecated'],
            'curl.options' => ['type' => 'deprecated'],
            'service' => [
                'type'     => 'value',
                'valid'    => 'string',
                'required' => true,
                'doc'      => 'Name of the service to utilize. This value will be supplied by default.'
            ],
            'scheme' => [
                'type'     => 'value',
                'valid'    => 'string',
                'default'  => 'https',
                'doc'      => 'URI scheme to use to connect. One of http or https.'
            ],
            'region' => [
                'type'     => 'value',
                'valid'    => 'string',
                'required' => true,
                'doc'      => 'Region to connect to. (e.g. sandbox, local, production)'
            ],
            'version' => [
                'type'     => 'value',
                'valid'    => 'string',
                'required' => true,
                'doc'      => 'The version of the webservice to utilize (e.g., 2015-01-01).'
            ],
            'endpoint'      => [
                'type'      => 'value',
                'valid'     => 'string',
                'doc'       => 'The full URI of the webservice. This is only required when connecting to a custom endpoint (e.g., a local version of Blackbox).'
            ],
            'defaults' => [
                'type'  => 'value',
                'valid' => 'array',
                'doc'   => 'An associative array of default parameters to pass to each operation created by the client.'
            ],
            'endpoint_provider' => [
                'type'     => 'pre',
                'valid'    => 'callable',
                'doc'      => 'An optional PHP callable that accepts a hash of options including a service and region key and returns a hash of endpoint data, of which the endpoint key is required.'
            ],
            'api_provider' => [
                'type'     => 'pre',
                'valid'    => 'callable',
                'doc'      => 'An optional PHP callable that accepts a type, service, and version argument, and returns an array of corresponding configuration data. The type value can be one of api, waiter, or paginator.'
            ],
            'class_name' => [
                'type'    => 'value',
                'valid'   => 'string',
                'default' => 'Vws\VwsClient',
                'doc'     => 'Optional class name of the client to create. This value will be supplied by default.'
            ],
            'exception_class' => [
                'type'    => 'value',
                'valid'   => 'string',
                'default' => 'Vws\Exception\VwsException',
                'doc'     => 'Optional exception class name to throw on request errors. This value will be supplied by default.'
            ],
            'profile' => [
                'type'  => 'pre',
                'valid' => 'string',
                'doc'   => 'Allows you to specify which profile to use when credentials are created from the VWS credentials file in your document root.'
            ],
            'credentials' => [
                'type'    => 'pre',
                'valid'   => 'array|Vws\Credentials\CredentialsInterface|bool|callable',
                'default' => true,
                'doc'     => 'An Vws\Credentials\CredentialsInterface object to use with each, an associative array of "username", "password", and "subscription_token" key value pairs, `false` to utilize null credentials, or a callable credentials provider function to create credentials using a function. If no credentials are provided or credentials is set to true, the SDK will attempt to load them from the environment.'
            ],
            'client' => [
                'type'    => 'pre',
                'valid'   => 'GuzzleHttp\ClientInterface|bool',
                'default' => true,
                'doc'     => 'Optional Guzzle client used to transfer requests over the wire. Set to true or do not specify a client, and the SDK will create a new client that uses a shared Ring HTTP handler with other clients.'
            ],
            'validate' => [
                'type'    => 'post',
                'valid'   => 'bool',
                'default' => true,
                'doc'     => 'Set to false to disable client-side parameter validation.'
            ],
            'debug' => [
                'type'  => 'post',
                'valid' => 'bool|resource',
                'doc'   => 'Set to true to display debug information when sending requests. Provide a stream resource to write debug information to a specific resource.'
            ],
            'client_defaults' => [
                'type'  => 'post',
                'valid' => 'array',
                'doc'   => 'Set to an array of Guzzle client request options (e.g., proxy, verify, etc.). See http://docs.guzzlephp.org/en/latest/clients.html#request-options for a list of available options.'
            ],
        ];
    }

    public function create(array $args = [])
    {
        $this->addDefaultArgs($args);

        foreach (static::getValidArguments() as $key => $a) {
            if (!array_key_exists($key, $args)) {
                if (isset($a['default'])) {
                    // Merge defaults in when not present.
                    $args[$key] = $a['default'];
                } elseif (!empty($a['required'])) {
                    // Allows custom error messages for missing values.
                    $message = method_exists($this, "missing_{$key}")
                        ? $this->{"missing_{$key}"}($args)
                        : "{$key} is a required client setting";
                    throw new \InvalidArgumentException($message);
                } else {
                    continue;
                }
            }
            $this->validate($key, $args[$key], $a['valid']);
            if ($a['type'] === 'pre') {
                $this->{"handle_{$key}"}($args[$key], $args);
            } elseif ($a['type'] === 'post') {
                $post[$key] = $args[$key];
            } elseif ($a['type'] === 'deprecated') {
                $meth = 'deprecated_' . str_replace('.', '_', $key);
                $this->{$meth}($args[$key], $args);
            }
        }

        $client = $this->createClient($args);

        $this->handle_client_defaults(isset($args['client_defaults']) ? $args['client_defaults'] : [], $args);
        $this->handle_validate(isset($args['validate_service']) ? $args['validate_service'] : true, $args, $client);

        $this->applyParser($client);

        return $client;
    }

    protected function createClient(array $args)
    {
        return new $args['class_name']($args);
    }

    /**
     * Apply default option arguments.
     *
     * @param array $args Arguments passed by reference
     */
    protected function addDefaultArgs(&$args)
    {
        $args['scheme'] = 'http';

        if (!isset($args['client']))
        {
            $clientArgs = [];
            $args['client'] = new Client($clientArgs);
        }

        if (!isset($args['api_provider'])) {
            $args['api_provider'] = new FilesystemApiProvider(__DIR__ . '/ressources');
        }

        if (!isset($args['endpoint_provider'])) {
            $args['endpoint_provider'] = EndpointProvider::fromDefaults();
        }
    }

    private function applyParser(VwsClientInterface $client)
    {
        $parser = ServiceModel::createParser($client->getApi());

        $client->getEmitter()->on(
            'process',
            function (ProcessEvent $e) use ($parser) {
                // Guard against exceptions and injected results.
                if ($e->getException() || $e->getResult()) {
                    return;
                }

                // Ensure a response exists in order to parse.
                $response = $e->getResponse();
                if (!$response) {
                    throw new \RuntimeException('No response was received.');
                }

                $e->setResult($parser($e->getCommand(), $response));
            }
        );
    }

    private function handle_client($value, array &$args)
    {
        // Make sure the user agent is prefixed by the SDK version
        $args['client']->setDefaultOption(
            'headers/User-Agent',
            'vws-php/' . Vdk::VERSION . ' ' . Client::getDefaultUserAgent()
        );
    }

    private function handle_api_provider($value, array &$args)
    {
        $api = new ServiceModel($value, $args['service'], $args['version']);
        $args['api'] = $api;
        $args['error_parser'] = ServiceModel::createErrorParser($api->getProtocol());
        $args['serializer'] = ServiceModel::createSerializer($api, $args['endpoint']);
    }

    private function handle_credentials($value, array &$args)
    {
        if ($value instanceof CredentialsInterface) {
            return;
        } elseif (is_callable($value)) {
            $args['credentials'] = CredentialProvider::resolve($value);
        } elseif ($value === true) {
            $default = CredentialProvider::defaultProvider();
            $args['credentials'] = CredentialProvider::resolve($default);
        } elseif (is_array($value)
                    && isset($value['username'])
                    && isset($value['password'])
                    && isset($value['subscription_token'])) {
            $args['credentials'] = new Credentials(
                $value['username'],
                $value['password'],
                $value['subscription_token']
            );
        } elseif ($value === false) {
            $args['credentials'] = new NullCredentials();
        }
    }

    private function handle_client_defaults($value, array &$args)
    {
        foreach ($value as $k => $v) {
            $args['client']->setDefaultOption($k, $v);
        }
    }

    private function handle_endpoint_provider($value, array &$args)
    {
        if (!isset($args['endpoint'])) {
            $result = call_user_func($value, [
                'service' => $args['service'],
                'region'  => $args['region'],
                'scheme'  => $args['scheme']
            ]);

            $args['endpoint'] = $result['endpoint'];
        }
    }

     protected function handle_validate(
        $value,
        array &$args,
        VwsClientInterface $client
    ) {
        if ($value !== true) {
            return;
        }

        $client->getEmitter()->attach(new Validation($args['api'], new Validator()));
    }

    private function handle_profile($value, array &$args)
    {
        $args['credentials'] = CredentialProvider::ini($args['profile']);
    }

    private function validate($name, $provided, $expected)
    {
        static $replace = ['integer' => 'int', 'boolean' => 'bool'];
        $type = strtr(gettype($provided), $replace);
        foreach (explode('|', $expected) as $valid) {
            if ($type === $valid
                || ($type === 'object' && $provided instanceof $valid)
                || ($valid === 'callable' && is_callable($provided))
            ) {
                return;
            }
        }

        throw new \InvalidArgumentException("Invalid configuration value "
            . "provided for {$name}. Expected {$expected}, but got "
            . Core::describeType($provided));
    }
}
