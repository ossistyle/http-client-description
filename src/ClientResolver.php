<?php

namespace Vws;

use GuzzleHttp\Event\EmitterInterface;
use Vws\Api\ApiProvider;
use Vws\Api\Service;
use Vws\Api\Validator;
use Vws\Credentials\Credentials;
use Vws\Credentials\CredentialsInterface;
use Vws\Subscriber\Validation;
use Vws\Endpoint\EndpointProvider;
use Vws\Credentials\CredentialProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\SimpleLogger;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;
use GuzzleHttp\Command\Subscriber\Debug;
use GuzzleHttp\Ring\Core;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * @internal Resolves a hash of client arguments to construct a client.
 */
class ClientResolver
{
    /** @var array */
    private $argDefinitions;

    /** @var array Map of types to a corresponding function */
    private static $typeMap = [
        'resource' => 'is_resource',
        'callable' => 'is_callable',
        'int'      => 'is_int',
        'bool'     => 'is_bool',
        'string'   => 'is_string',
        'object'   => 'is_object',
        'array'    => 'is_array',
    ];

    private static $defaultArgs = [
        'service' => [
            'type'     => 'value',
            'valid'    => ['string'],
            'doc'      => 'Name of the service to utilize. This value will be supplied by default when using one of the SDK clients (e.g., Vws\\Blackbox\\BlackboxClient).',
            'required' => true,
        ],
        'scheme' => [
            'type'     => 'value',
            'valid'    => ['string'],
            'default'  => 'https',
            'doc'      => 'URI scheme to use when connecting connect. The SDK will utilize "https" endpoints (i.e., utilize SSL/TLS connections) by default. You can attempt to connect to a service over an unencrypted "http" endpoint by setting ``scheme`` to "http".',
        ],
        'endpoint' => [
            'type'  => 'value',
            'valid' => ['string'],
            'doc'   => 'The full URI of the webservice. This is only required when connecting to a custom endpoint (e.g., a local version of S3).',
        ],
        'region' => [
            'type'     => 'value',
            'valid'    => ['string'],
            'required' => [__CLASS__, '_missing_region'],
            'doc'      => 'Region to connect to.',
        ],
        'version' => [
            'type'     => 'value',
            'valid'    => ['string'],
            'required' => [__CLASS__, '_missing_version'],
            'doc'      => 'The version of the webservice to utilize (e.g., 2006-03-01).',
        ],
        'endpoint_provider' => [
            'type'     => 'value',
            'valid'    => ['callable'],
            'fn'       => [__CLASS__, '_apply_endpoint_provider'],
            'doc'      => 'An optional PHP callable that accepts a hash of options including a "service" and "region" key and returns NULL or a hash of endpoint data, of which the "endpoint" key is required. See Vws\\Endpoint\\EndpointProvider for a list of built-in providers.',
            'default' => [__CLASS__, '_default_endpoint_provider'],
        ],
        'api_provider' => [
            'type'     => 'value',
            'valid'    => ['callable'],
            'doc'      => 'An optional PHP callable that accepts a type, service, and version argument, and returns an array of corresponding configuration data. The type value can be one of api, waiter, or paginator.',
            'fn'       => [__CLASS__, '_apply_api_provider'],
            'default'  => [ApiProvider::class, 'defaultProvider'],
        ],
        'profile' => [
            'type'  => 'config',
            'valid' => ['string'],
            'doc'   => 'Allows you to specify which profile to use when credentials are created from the Vws credentials file in your HOME directory. This setting overrides the Vws_PROFILE environment variable. Note: Specifying "profile" will cause the "credentials" key to be ignored.',
            'fn'    => [__CLASS__, '_apply_profile'],
        ],
        'credentials' => [
            'type'    => 'value',
            'valid'   => ['Vws\Credentials\CredentialsInterface', 'array', 'bool', 'callable'],
            'doc'     => 'Specifies the credentials used to sign requests. Provide an Vws\Credentials\CredentialsInterface object, an associative array of "key", "secret", and an optional "token" key, `false` to use null credentials, or a callable credentials provider used to create credentials or return null. See Vws\\Credentials\\CredentialProvider for a list of built-in credentials providers. If no credentials are provided, the SDK will attempt to load them from the environment.',
            'fn'      => [__CLASS__, '_apply_credentials'],
            'default' => [__CLASS__, '_default_credentials'],
        ],
        'client' => [
            'type'    => 'value',
            'valid'   => ['callable', 'GuzzleHttp\ClientInterface'],
            'default' => [__CLASS__, '_default_client'],
            'fn'      => [__CLASS__, '_apply_client'],
            'doc'     => 'A function that accepts an array of options and returns a GuzzleHttp\ClientInterface, or a Guzzle client used to transfer requests over the wire.',
        ],
        'validate' => [
            'type'    => 'value',
            'valid'   => ['bool'],
            'default' => true,
            'doc'     => 'Set to false to disable client-side parameter validation.',
            'fn'      => [__CLASS__, '_apply_validate'],
        ],
        'log' => [
            'type'    => 'value',
            'valid'   => ['bool'],
            'default' => false,
            'doc'     => 'Set to true to enable resquest/response logging.',
            'fn'      => [__CLASS__, '_apply_logger'],
        ],
        'log_filename' => [
            'type'    => 'value',
            'valid'   => ['bool', 'string'],
            'default' => false,
            'doc'     => 'Path and filename for logger.',
        ],
        'debug' => [
            'type'  => 'value',
            'valid' => ['bool', 'resource'],
            'doc'   => 'Set to true to display debug information when sending requests. Provide a stream resource to write debug information to a specific resource.',
            'fn'    => [__CLASS__, '_apply_debug'],
        ],
        'http' => [
            'type'  => 'value',
            'valid' => ['array'],
            'doc'   => 'Set to an array of Guzzle client request options (e.g., proxy, verify, etc.). See http://docs.guzzlephp.org/en/latest/clients.html#request-options for a list of available options.',
            'fn'    => [__CLASS__, '_apply_http'],
        ],
    ];

    /**
     * Gets an array of default client arguments, each argument containing a
     * hash of the following:.
     *
     * - type: (string, required) option type described as follows:
     *   - value: The default option type.
     *   - config: The provided value is made available in the client's
     *     getConfig() method.
     * - valid: (array, required) Valid PHP types or class names. Note: null
     *   is not an allowed type.
     * - required: (bool, callable) Whether or not the argument is required.
     *   Provide a function that accepts an array of arguments and returns a
     *   string to provide a custom error message.
     * - default: (mixed) The default value of the argument if not provided. If
     *   a function is provided, then it will be invoked to provide a default
     *   value. The function is provided the array of options and is expected
     *   to return the default value of the option.
     * - doc: (string) The argument documentation string.
     * - fn: (callable) Function used to apply the argument. The function
     *   accepts the provided value, array of arguments by reference, and an
     *   event emitter.
     *
     * Note: Order is honored and important when applying arguments.
     *
     * @return array
     */
    public static function getDefaultArguments()
    {
        return self::$defaultArgs;
    }

    /**
     * @param array $argDefinitions Client arguments.
     */
    public function __construct(array $argDefinitions)
    {
        $this->argDefinitions = $argDefinitions;
    }

    /**
     * Resolves client configuration options and attached event listeners.
     *
     * @param array            $args    Provided constructor arguments.
     * @param EmitterInterface $emitter Emitter to augment..
     *
     * @return array Returns the array of provided options.
     *
     * @throws \InvalidArgumentException
     *
     * @see Vws\VwsClient::__construct for a list of available options.
     */
    public function resolve(array $args, EmitterInterface $emitter)
    {
        $args['config'] = [];
        foreach ($this->argDefinitions as $key => $a) {
            // Add defaults, validate required values, and skip if not set.
            if (!isset($args[$key])) {
                if (isset($a['default'])) {
                    // Merge defaults in when not present.
                    $args[$key] = is_callable($a['default'])
                        ? $a['default']($args)
                        : $a['default'];
                } elseif (empty($a['required'])) {
                    continue;
                } else {
                    $this->throwRequired($args);
                }
            }

            // Validate the types against the provided value.
            foreach ($a['valid'] as $check) {
                if (isset(self::$typeMap[$check])) {
                    $fn = self::$typeMap[$check];
                    if ($fn($args[$key])) {
                        goto is_valid;
                    }
                } elseif ($args[$key] instanceof $check) {
                    goto is_valid;
                }
            }

            $this->invalidType($key, $args[$key]);

            // Apply the value
            is_valid:
            if (isset($a['fn'])) {
                $a['fn']($args[$key], $args, $emitter);
            }

            if ($a['type'] === 'config') {
                $args['config'][$key] = $args[$key];
            }
        }

        return $args;
    }

    /**
     * Creates a verbose error message for an invalid argument.
     *
     * @param string $name        Name of the argument that is missing.
     * @param array  $args        Provided arguments
     * @param bool   $useRequired Set to true to show the required fn text if
     *                            available instead of the documentation.
     *
     * @return string
     */
    private function getArgMessage($name, $args = [], $useRequired = false)
    {
        $arg = $this->argDefinitions[$name];
        $msg = '';
        $modifiers = [];
        if (isset($arg['valid'])) {
            $modifiers[] = implode('|', $arg['valid']);
        }
        if (isset($arg['choice'])) {
            $modifiers[] = 'One of '.implode(', ', $arg['choice']);
        }
        if ($modifiers) {
            $msg .= '('.implode('; ', $modifiers).')';
        }
        $msg = wordwrap("{$name}: {$msg}", 75, "\n  ");

        if ($useRequired && is_callable($arg['required'])) {
            $msg .= "\n\n  ";
            $msg .= str_replace("\n", "\n  ", call_user_func($arg['required'], $args));
        } elseif (isset($arg['doc'])) {
            $msg .= wordwrap("\n\n  {$arg['doc']}", 75, "\n  ");
        }

        return $msg;
    }

    /**
     * Throw when an invalid type is encountered.
     *
     * @param string $name     Name of the value being validated.
     * @param mixed  $provided The provided value.
     *
     * @throws \InvalidArgumentException
     */
    private function invalidType($name, $provided)
    {
        $expected = implode('|', $this->argDefinitions[$name]['valid']);
        $msg = "Invalid configuration value "
            ."provided for \"{$name}\". Expected {$expected}, but got "
            .Core::describeType($provided)."\n\n"
            .$this->getArgMessage($name);
        throw new \InvalidArgumentException($msg);
    }

    /**
     * Throws an exception for missing required arguments.
     *
     * @param array $args Passed in arguments.
     *
     * @throws \InvalidArgumentException
     */
    private function throwRequired(array $args)
    {
        $missing = [];
        foreach ($this->argDefinitions as $k => $a) {
            if (empty($a['required'])
                || isset($a['default'])
                || array_key_exists($k, $args)
            ) {
                continue;
            }
            $missing[] = $this->getArgMessage($k, $args, true);
        }
        $msg = "Missing required client configuration options: \n\n";
        $msg .= implode("\n\n", $missing);
        throw new \InvalidArgumentException($msg);
    }

    public static function _apply_credentials($value, array &$args)
    {
        if ($value instanceof CredentialsInterface) {
            return;
        } elseif (is_callable($value)) {
            // Invoke the credentials provider and throw if it does not resolve.
            $args['credentials'] = CredentialProvider::resolve($value);
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
            $args['credentials'] = false;
        } else {
            throw new \InvalidArgumentException('Credentials must be an instance of '
                .'Vws\Credentials\CredentialsInterface, an associative '
                .'array that contains "username", "password",
                . "subscriptiontoken", "vendor" and "version" '
                .'key-value pairs, a credentials provider function, or false.'
            );
        }
    }

    public static function _apply_api_provider($value, array &$args)
    {
        $api = new Service(
            ApiProvider::resolve(
                $value,
                'api',
                $args['service'],
                $args['version']
            ),
            $value
        );
        $args['api'] = $api;
        $args['error_parser'] = Service::createErrorParser($api->getProtocol());
        $args['serializer'] = Service::createSerializer($api, $args['endpoint']);
    }

    public static function _apply_endpoint_provider(callable $value, array &$args)
    {
        if (!isset($args['endpoint'])) {
            // Invoke the endpoint provider and throw if it does not resolve.
            $result = EndpointProvider::resolve($value, [
                'service' => $args['service'],
                'region'  => $args['region'],
                'scheme'  => $args['scheme'],
            ]);

            $args['endpoint'] = $result['endpoint'];
        }
    }

    public static function _apply_debug($value, $_, EmitterInterface $em)
    {
        if ($value !== false) {
            $em->attach(new Debug(
                $value === true ? [] : $value
            ));
        }
    }

    public static function _apply_client($value, array &$args)
    {
        if (is_callable($value)) {
            $args['client'] = $value($args);
        }
    }

    public static function _apply_logger($value, array &$args, EmitterInterface $em)
    {
        if ($value === true) {

            $fileName = isset($args['log_filename']) ? $args['log_filename'] : $args['api']->getEndpointPrefix() . '_' . $args['api']->getApiVersion();

            $log = new Logger($args['api']->getEndpointPrefix());
            $log->pushHandler(new StreamHandler("/tmp/{$fileName}.log", Logger::DEBUG, true, 0777, true));
            $subscriber = new LogSubscriber($log, Formatter::DEBUG);
            $args['client']->getEmitter()->attach($subscriber);
        }
    }

    public static function _apply_http(array $values, array &$args)
    {
        foreach ($values as $k => $v) {
            $args['client']->setDefaultOption($k, $v);
        }
    }

    public static function _apply_profile($_, array &$args)
    {
        $args['credentials'] = CredentialProvider::ini($args['profile']);
    }

    public static function _apply_ringphp_handler()
    {
        throw new \InvalidArgumentException('You cannot provide both a client option and a ringphp_handler option.');
    }

    public static function _apply_validate($value, array &$args, EmitterInterface $em)
    {
        if ($value === true) {
            $em->attach(new Validation($args['api'], new Validator()));
        }
    }

    public static function _default_client(array &$args)
    {
        return new Client();
    }

    public static function _default_credentials()
    {
        return CredentialProvider::resolve(
            CredentialProvider::defaultProvider()
        );
    }

    public static function _default_endpoint_provider()
    {
        return EndpointProvider::defaultProvider();
    }

    public static function _missing_version(array $args)
    {
        $service = isset($args['service']) ? $args['service'] : '';
        $versions = ApiProvider::defaultProvider()->getVersions($service);
        $versions = implode("\n", array_map(function ($v) {
            return "* \"$v\"";
        }, $versions)) ?: '* (none found)';

        return <<<EOT
A "version" configuration value is required. Specifying a version constraint
ensures that your code will not be affected by a breaking change made to the
service. For example, when using Vws Blackbox, you can lock your API version to
"2015-01-01".

Your build of the Sdk has the following version(s) of "{$service}": {$versions}

You may provide "latest" to the "version" configuration value to utilize the
most recent available API version that your client's API provider can find.
Note: Using 'latest' in a production application is not recommended '.
EOT;
    }

    public static function _missing_region(array $args)
    {
        $service = isset($args['service']) ? $args['service'] : '';

        return <<<EOT
A "region" configuration value is required for the "{$service}" service
(e.g., "sandbox" or "production").
EOT;
    }

    public static function _wrapDebugLogger(array $clientArgs, array $conf)
    {
        // Add retry logger
        if (isset($clientArgs['retry_logger'])) {
            $conf['delay'] = RetrySubscriber::createLoggingDelay(
                $conf['delay'],
                ($clientArgs['retry_logger'] === 'debug')
                    ? new SimpleLogger()
                    : $clientArgs['retry_logger']
            );
        }

        return $conf;
    }
}
