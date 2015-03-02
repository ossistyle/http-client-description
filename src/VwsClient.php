<?php

namespace Vws;

use GuzzleHttp\Command\AbstractClient;
use GuzzleHttp\Command\Command;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\CommandTransaction;
use GuzzleHttp\Exception\RequestException;
use Vws\Api\ServiceModel;
use Vws\Exception\VwsException;

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

    /** @var callable */
    private $errorParser;

    /** @var string */
    private $commandException;

    /**
     * Get an array of client constructor arguments used by the client.
     *
     * @return array
     */
    public static function getArguments()
    {
        return ClientResolver::getDefaultArguments();
    }

    public function __construct(array $args)
    {
        $service = $this->parseClass();
        $withResolved = null;

        if (!isset($args['service'])) {
            $args['service'] = $service;
        }

        $resolver = new ClientResolver(static::getArguments());
        $config = $resolver->resolve($args, $this->getEmitter());
        $this->api = $config['api'];
        $this->serializer = $config['serializer'];
        $this->errorParser = $config['error_parser'];
        $this->signatureProvider = $config['signature_provider'];
        $this->endpoint = $config['endpoint'];
        $this->credentials = $config['credentials'];
        $this->region = isset($config['region']) ? $config['region'] : null;
        $this->applyParser();
        $this->initSigners($config['config']['signature_version']);
        parent::__construct($config['client'], $config['config']);

        // Make sure the user agent is prefixed by the SDK version.
        $client = $this->getHttpClient();
        $client->setDefaultOption('allow_redirects', false);
        $client->setDefaultOption(
            'headers/User-Agent',
            'aws-sdk-php/' . Sdk::VERSION . ' ' . Client::getDefaultUserAgent()
        );

        if (isset($args['with_resolved'])) {
            /** @var callable $withResolved */
            $args['with_resolved']($config);
        }
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

    /**
     * Executes an VWS command.
     *
     * @param CommandInterface $command Command to execute
     *
     * @return mixed Returns the result of the command
     * @throws VwsException when an error occurs during transfer
     */
    public function execute(CommandInterface $command)
    {
        try {
            return parent::execute($command);
        } catch (VwsException $e) {
            throw $e;
        } catch (\Exception $e) {
            // Wrap other uncaught exceptions for consistency
            $exceptionClass = $this->commandException;
            throw new $exceptionClass(
                sprintf('Uncaught exception while executing %s::%s - %s',
                    get_class($this),
                    $command->getName(),
                    $e->getMessage()),
                new CommandTransaction($this, $command),
                $e
            );
        }
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

    public function createCommandException(CommandTransaction $transaction)
    {
        // Throw AWS exceptions as-is
        if ($transaction->exception instanceof VwsException) {
            return $transaction->exception;
        }

        // Set default values (e.g., for non-RequestException)
        $url = null;
        $transaction->context['vws_error'] = [];
        $serviceError = $transaction->exception->getMessage();

        if ($transaction->exception instanceof RequestException) {
            $url = $transaction->exception->getRequest()->getUrl();
            if ($response = $transaction->exception->getResponse()) {
                $parser = $this->errorParser;
                // Add the parsed response error to the exception.
                $transaction->context['vws_error'] = $parser($response);
                // Only use the AWS error code if the parser could parse response.
                if (!$transaction->context->getPath('vws_error/type')) {
                    $serviceError = $transaction->exception->getMessage();
                } else {
                    // Create an easy to read error message.
                    $serviceError = trim($transaction->context->getPath('vws_error/code')
                        . ' (' . $transaction->context->getPath('vws_error/type')
                        . ' error): ' . implode('\r\n', array_column($transaction->context->getPath('vws_error/messages'), 'message'))
                    );
                }
            }
        }

        $exceptionClass = $this->commandException;

        return new $exceptionClass(
            sprintf('Error executing %s::%s() on "%s"; %s',
                get_class($this),
                lcfirst($transaction->command->getName()),
                $url,
                $serviceError
            ),
            $transaction,
            $transaction->exception
        );
    }
}
