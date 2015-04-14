<?php

namespace Vws;

use GuzzleHttp\Client;
use GuzzleHttp\Command\AbstractClient;
use GuzzleHttp\Command\Command;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\CommandTransaction;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Command\Event\ProcessEvent;
use Vws\Api\Service;
use Vws\Exception\VwsException;

/**
 *
 */
class VwsClient extends AbstractClient implements VwsClientInterface
{
    /** @var array Default command options */
    private $defaults;

    /** @var string */
    private $region;

    /** @var string */
    private $endpoint;

    /** @var Service */
    private $api;

    /** @var callable */
    private $serializer;

    /** @var callable */
    private $errorParser;

    /** @var string */
    private $commandException = 'Vws\Exception\VwsException';

    /**
     * Get an array of client constructor arguments used by the client.
     *
     * @return array
     */
    public static function getArguments()
    {
        return ClientResolver::getDefaultArguments();
    }

    /**
     * The client constructor accepts the following options:.
     *
     * - api_provider: (callable) An optional PHP callable that accepts a
     *   type, service, and version argument, and returns an array of
     *   corresponding configuration data. The type value can be one of api,
     *   waiter, or paginator.
     * - client: (GuzzleHttp\ClientInterface) Optional Guzzle client used to
     *   transfer requests over the wire. If you do not specify a client, the
     *   SDK will create a new client that uses a shared Ring HTTP handler
     *   with other clients.
     * - credentials:
     *   (array|Vws\Credentials\CredentialsInterface|bool|callable) An
     *   Vws\Credentials\CredentialsInterface object to use with each, an
     *   associative array of "username", "password", and "subscription_token" key value pairs,
     *   `false` to utilize null credentials, or a callable credentials
     *   provider function to create credentials using a function. If no
     *   credentials are provided, the SDK will attempt to load them from the
     *   environment.
     * - debug: (bool|resource) Set to true to display debug information
     *   when sending requests. Provide a stream resource to write debug
     *   information to a specific resource.
     * - endpoint: (string) The full URI of the webservice. This is only
     *   required when connecting to a custom endpoint (e.g., a local version
     *   of S3).
     * - endpoint_provider: (callable) An optional PHP callable that
     *   accepts a hash of options including a service and region key and
     *   returns a hash of endpoint data, of which the endpoint key is
     *   required.
     * - http: (array) Set to an array of Guzzle client request options
     *   (e.g., proxy, verify, etc.). See
     *   http://docs.guzzlephp.org/en/latest/clients.html#request-options for a
     *   list of available options.
     * - profile: (string) Allows you to specify which profile to use when
     *   credentials are created from the Vws credentials file in your HOME
     *   directory. This setting overrides the Vws_PROFILE environment
     *   variable. Note: Specifying "profile" will cause the "credentials" key
     *   to be ignored.
     * - region: (string, required) Region to connect to.
     * - retries: (int, default=int(3)) Configures the maximum number of
     *   allowed retries for a client (pass 0 to disable retries).
     * - retry_logger: (string|Psr\Log\LoggerInterface) When the string "debug"
     *   is provided, all retries will be logged to STDOUT. Provide a PSR-3
     *   logger to log retries to a specific logger instance.
     * - ringphp_handler: (callable) RingPHP handler used to transfer HTTP
     *   requests (see http://ringphp.readthedocs.org/en/latest/).
     * - scheme: (string, default=string(5) "https") URI scheme to use when
     *   connecting connect.
     * - service: (string, required) Name of the service to utilize. This
     *   value will be supplied by default.
     * - validate: (bool, default=bool(true)) Set to false to disable
     *   client-side parameter validation.
     * - version: (string, required) The version of the webservice to
     *   utilize (e.g., 2006-03-01).
     *
     * @param array $args Client configuration arguments.
     *
     * @throws \InvalidArgumentException if any required options are missing
     */
    public function __construct(array $args)
    {
        $service = $this->parseClass();

        if (!isset($args['service'])) {
            $args['service'] = $service;
        }

        $resolver = new ClientResolver(static::getArguments());
        $config = $resolver->resolve($args, $this->getEmitter());
        $this->api = $config['api'];
        $this->serializer = $config['serializer'];
        $this->errorParser = $config['error_parser'];

        $this->endpoint = $config['endpoint'];
        $this->credentials = $config['credentials'];
        $this->region = isset($config['region']) ? $config['region'] : null;
        $this->applyParser();

        parent::__construct($config['client'], $config['config']);

        // Make sure the user agent is prefixed by the SDK version.
        $client = $this->getHttpClient();
        $client->setDefaultOption('allow_redirects', false);
        $client->setDefaultOption(
            'headers/User-Agent',
            'vws-sdk-php/'.Sdk::VERSION.' '.Client::getDefaultUserAgent()
        );

        if (isset($args['with_resolved'])) {
            /* @var callable $withResolved */
            $args['with_resolved']($config);
        }
    }

    /**
     * [getCredentials description].
     *
     * @return
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * [getEndpoint description].
     *
     * @return
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * [getRegion description].
     *
     * @return
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * [getApi description].
     *
     * @return
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Executes an Vws command.
     *
     * @param CommandInterface $command Command to execute
     *
     * @return mixed Returns the result of the command
     *
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
                    $e->getMessage()
                ),
                new CommandTransaction($this, $command),
                $e
            );
        }
    }

    /**
     * [getCommand description].
     *
     * @param [type] $name [description]
     * @param [type] $args [description]
     *
     * @return
     */
    public function getCommand($name, array $args = [])
    {
        // Fail fast if the command cannot be found in the description.
        if (!isset($this->api['operations'][$name])) {
            $name = ucfirst($name);
            if (!isset($this->api['operations'][$name])) {
                throw new \InvalidArgumentException("Operation not found: $name");
            }
        }
        if (isset($args['@future'])) {
            $future = $args['@future'];
            unset($args['@future']);
        } else {
            $future = false;
        }

        return new Command($name, $args, [
            'emitter' => clone $this->getEmitter(),
            'future' => $future,
        ]);
    }

    /**
     * [getIterator description].
     *
     * @param [type] $name [description]
     * @param [type] $args [description]
     *
     * @return
     */
    public function getIterator($name, array $args = [])
    {
        $config = $this->api->getPaginatorConfig($name);

        $key = $config['result_key'];

        if ($config['more_results']) {
            return $this->getPaginator($name, $args)->search($key);
        }

        $result = $this->getCommand($name, $args)->search($key);

        return new \ArrayIterator((array) $result);
    }

    /**
     * [getPaginator description].
     *
     * @param [type] $name   [description]
     * @param [type] $args   [description]
     * @param [type] $config [description]
     *
     * @return
     */
    public function getPaginator($name, array $args = [], array $config = [])
    {
        $config += $this->api->getPaginatorConfig($name);

        return new ResultPaginator($this, $name, $args, $config);
    }

    protected function serializeRequest(CommandTransaction $trans)
    {
        $fn = $this->serializer;

        return $fn($trans);
    }

    /**
     * [createCommandException description].
     *
     * @param CommandTransaction $transaction [description]
     *
     * @return
     */
    public function createCommandException(CommandTransaction $transaction)
    {
        // Throw Vws exceptions as-is
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
                // Only use the Vws error code if the parser could parse response.
                if (!$transaction->context->getPath('vws_error/type')) {
                    $serviceError = $transaction->exception->getMessage();
                } else {
                    // Create an easy to read error message.
                    $serviceError = trim($transaction->context->getPath('vws_error/code')
                        .' ('.$transaction->context->getPath('vws_error/type')
                        .' error): '.implode('\r\n', array_column($transaction->context->getPath('vws_error/messages'), 'message'))
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

    private function parseClass()
    {
        $class = get_class($this);
        if ($class === __CLASS__) {
            return '';
        }
        $service = substr($class, strrpos($class, '\\') + 1, -6);
        $this->commandException = "Vws\\{$service}\\Exception\\{$service}Exception";

        return strtolower($service);
    }

    private function applyParser()
    {
        $parser = Service::createParser($this->api);
        $this->getEmitter()->on(
            'process',
            static function (ProcessEvent $e) use ($parser) {
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
}
