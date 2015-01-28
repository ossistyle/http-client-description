<?php

namespace Vws;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Command\Subscriber\Debug;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Vws\Api\FilesystemApiProvider;
use Vws\Api\ServiceModel;
use Vws\Credentials\Credentials;
use Vws\Credentials\CredentialsInterface;
use Vws\Credentials\NullCredentials;
use Vws\Credentials\Provider as CredentialProvider;
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


    public function create(array $args = [])
    {
        $this->addDefaultArgs($args);



        foreach ($this->requiredArguments as $required) {
            if (!array_key_exists($required, $args)) {
                throw new \InvalidArgumentException("{$required} is a required client setting");
            }
        }

        $this->handle_credentials(isset($args['credentials']) ? $args['credentials'] : true, $args);
        $this->handle_endpoint_provider($args['endpoint_provider'], $args);
        $this->handle_api_provider($args['api_provider'] ? $args['api_provider'] : true, $args);
        $this->handle_class_name(isset($args['class_name']) ? $args['class_name'] : true, $args);
        $this->handle_client($args['client'], $args);

        $client = $this->createClient($args);

        #$client->getEmitter()->attach(new Debug([]));
        $this->handle_client_defaults(isset($args['client_defaults']) ? $args['client_defaults'] : [], $args);
        $this->applyParser($client);

        return $client;
    }

    protected function createClient(array $args)
    {
        return new $args['client_class']($args);
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
        if (!($value instanceof ClientInterface)) {
            throw new \InvalidArgumentException('client must be an instance of GuzzleHttp\ClientInterface');
        }

        // Make sure the user agent is prefixed by the SDK version
        $args['client']->setDefaultOption(
            'headers/User-Agent',
            'vws-php/' . Vdk::VERSION . ' ' . Client::getDefaultUserAgent()
        );
    }

    private function handle_class_name($value, array &$args)
    {
        if ($value === true) {
            $args['client_class'] = 'Vws\VwsClient';
//            $args['exception_class'] = 'Vws\Exception\VwsException';
        } else {
            // An explicitly provided class_name must be found.
            $args['client_class'] = "Vws\\{$value}\\{$value}Client";
            if (!class_exists($args['client_class'])) {
                throw new \RuntimeException("Client not found for $value");
            }
//            $args['exception_class']  = "Vws\\{$value}\\Exception\\{$value}Exception";
//            if (!class_exists($args['exception_class'] )) {
//                throw new \RuntimeException("Exception class not found $value");
//            }
        }
    }

    private function handle_api_provider($value, array &$args)
    {
        if (!is_callable($value)) {
            throw new \InvalidArgumentException('api_provider must be callable');
        }

        $api = new ServiceModel($value, $args['service'], $args['version']);
        $args['api'] = $api;
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
        } elseif (is_array($value) && isset($value['username']) && isset($value['password']) && isset($value['subscription_token'])) {
            $args['credentials'] = new Credentials(
                $value['username'],
                $value['password'],
                $value['subscription_token']
            );
        } elseif ($value === false) {
            $args['credentials'] = new NullCredentials();
        } else {
            throw new \InvalidArgumentException('Credentials must be an instance of '
                . 'Vws\Credentials\CredentialsInterface, an associative '
                . 'array that contains "username", "password", and "subscription_token" '
                . 'key-value pairs, a credentials provider function, or false.');
        }
    }

    private function handle_client_defaults($value, array &$args)
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('client_defaults must be an array');
        }

        foreach ($value as $k => $v) {
            $args['client']->setDefaultOption($k, $v);
        }
    }

    private function handle_endpoint_provider($value, array &$args)
    {
        if (!is_callable($value)) {
            throw new \InvalidArgumentException('endpoint_provider must be a callable that returns an endpoint array.');
        }

        if (!isset($args['endpoint'])) {
            $result = call_user_func($value, [
                'service' => $args['service'],
                'region'  => $args['region'],
                'scheme'  => $args['scheme']
            ]);

            $args['endpoint'] = $result['endpoint'];
        }
    }
}
