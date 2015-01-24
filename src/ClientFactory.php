<?php

namespace Vws;

use Aws\Credentials\CredentialsInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Vws\Api\FilesystemApiProvider;
use Vws\Api\ServiceModel;
use Vws\Credentials\Credentials;
use Vws\Credentials\Provider as CredentialProvider;
use Vws\Credentials\NullCredentials;
use Vws\Vdk;
use Vws\VwsClientInterface;

class ClientFactory
{
    public function create(array $args = [])
    {
        $this->addDefaultArgs($args);

        $this->handle_credentials(isset($args['credentials']) ? $args['credentials'] : true, $args);
        $this->handle_endpoint_provider($args['endpoint_provider'], $args);
        $this->handle_api_provider($args['api_provider'] ? $args['api_provider'] : true, $args);
        $this->handle_class_name($args['class_name'], $args);
        $this->handle_client($args['client'], $args);

        $client = $this->createClient($args);

        return $client;
    }

    protected function postCreate(VwsClientInterface $client, array $args)
    {
        // Apply the protocol of the service description to the client.
        $this->applyParser($client);
        // Attach a signer to the client.
        $credentials = $client->getCredentials();

        // Null credentials don't sign requests.
        if (!($credentials instanceof NullCredentials)) {
            $client->getHttpClient()->getEmitter()->attach(
                new Signature($credentials, $client->getSignature())
            );
        }
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
        $args['scheme'] = 'https';

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
            $args['exception_class'] = 'Vws\Exception\VwsException';
        } else {
            // An explicitly provided class_name must be found.
            $args['client_class'] = "Vws\\{$value}\\{$value}Client";
            if (!class_exists($args['client_class'])) {
                throw new \RuntimeException("Client not found for $value");
            }
            $args['exception_class']  = "Vws\\{$value}\\Exception\\{$value}Exception";
            if (!class_exists($args['exception_class'] )) {
                throw new \RuntimeException("Exception class not found $value");
            }
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
