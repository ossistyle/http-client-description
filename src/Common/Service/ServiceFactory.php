<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Command\Guzzle\Description;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Via\Common\Enum\EndPoint;
use Via\Common\Event\AuthHandler;
use Via\Common\Event\PrepareRequest;

/**
 * Description of ServiceFactory
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class ServiceFactory
{

    /**
     * @var array User-defined configuration options
     */
    private $userOptions = [];

    /**
     * @var array configuration options for the client and service
     */
    private $options = [];

    /**
     * @var ClientInterface The HTTP client
     */
    private $httpClient;

    /**
     * @var Description The description object which contains details of how an
     * API service is defined. This object encapsulates all of
     * the operations and models needed for operation.
     */
    private $description;

    /**
     * @param array $userOptions User-defined options
     */
    public function __construct(array $userOptions = [])
    {
        $this->userOptions = $userOptions;
        $this->configureBaseUrl($userOptions);
        $this->configureDefaults($userOptions);
        $this->mergeDefaults();
    }

    /**
     * Internal method for ensuring that the user has passed in all required
     * options.
     *
     * @throws InvalidArgumentException If a required option is omitted
     */
    private function validateOptions()
    {
        $requiredOptions = ['username', 'password', 'subscription_token', 'vendor', 'version'];
        $missing = [];
        foreach ($requiredOptions as $requiredOption) {
            if (empty($this->userOptions[$requiredOption])) {
                $missing[] = $requiredOption;
            } else {
                //$this->userOptions['auth'][$requiredOption] = $this->userOptions[$requiredOption];
                //unset($this->userOptions[$requiredOption]);
            }
        }
        if (count($missing)) {
            throw new \InvalidArgumentException(sprintf(
                    "These required options are either not set or empty: %s", implode(', ', $missing)
            ));
        }
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param Description $description
     */
    public function setDescription(Description $description)
    {
        $this->description = $description;
    }

    /**
     * Merges the current options array with a new one
     *
     * @param array $options
     */
    public function mergeUserOptions(array $options)
    {
        $this->userOptions = array_merge($this->userOptions, $options);
    }

    /**
     * @return array
     */
    public function getUserOptions()
    {
        return $this->userOptions;
    }

    private function getOptions()
    {
        $options = [
                'base_url' => $this->options['base_url'],
                'defaults' => $this->options['defaults'],
            ];

        return $options;
    }

    private function configureDefaults($config)
    {
        if (!isset($config['defaults'])) {
            $this->options['defaults'] = $this->getDefaultOptions();
        } else {
            $this->options['defaults'] = array_replace(
                $this->getDefaultOptions(),
                $config['defaults']
            );
        }
    }

    public function configureBaseUrl($config)
    {
        if (!isset($config['base_url'])) {
            $this->options['base_url'] = EndPoint::SANDBOX_URL_TYPE;
        } else {
            $this->options['base_url'] = $config['base_url'];
        }
    }

    /**
     * Merges default options into the array passed by reference.
     *
     * @param array $options Options to modify by reference
     *
     * @return array
     */
    private function mergeDefaults()
    {
        $defaults = $this->options['defaults'];
        $userDefaults = (isset($this->userOptions['defaults'])) ? $this->userOptions['defaults'] : [];

        $this->options['defaults'] = array_replace_recursive($defaults, $userDefaults);
    }

    /**
     * Get an array of default options to apply to the client
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        $settings = [
            'allow_redirects' => false,
            'exceptions'      => true,
            'verify'          => true,
            'timeout'         => 10
        ];

        return $settings;
    }

    /**
     * Creates a new service object. It takes a name, finds its FQCN and injects
     * all the required dependencies.
     *
     * @param string $serviceName The case-insensitive name of the service. This
     *                            is the human-readable version of the Via
     *                            service, not a codename.
     *
     * @param array $options Optional configuration options specific to
     *                       this service. These are merged with the
     *                       pre-existing options.
     *
     * @return mixed
     * @throws InvalidArgumentException If the service class cannot be found
     */
    public function create($serviceName)
    {
        $this->validateOptions();
        $class = sprintf("Via\\Description\\%s\\Service", ucfirst($serviceName));

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf("%s does not exist", $class));
        }
        
        $options = $this->getOptions();
        
        if (!$this->httpClient) {            
            $this->setHttpClient(new Client($options));
        }
        if (!$this->description) {
            $array = $this->findJsonArray($serviceName, $this->findApiVersion($class));
            $defaultDescription = $this->findDefaultsJsonArray($this->findApiVersion($class));
            $array = array_merge_recursive($array, $defaultDescription);
            $this->setDescription(new Description($array));
        }

        $service = new $class($this->httpClient, $this->description, $options);

        foreach ($this->getHandlers() as $handler) {
            $service->getEmitter()->attach($handler);
        }

        return $service;
    }
    
    private function getHandlers()
    {
        return [
            new PrepareRequest(clone $this->httpClient, $this->description),
            new AuthHandler(clone $this->httpClient, $this->userOptions),
        ];
    }

    /**
     * Internal method for finding a suitable API version for a particular
     * service. First it looks to see if the user has defined it themselves,
     * and if not, it looks to see whether there is a STABLE_VERSION constant
     * set on the service class.
     *
     * @param string $class The service you are finding a version for
     *
     * @return float
     * @throws InvalidArgumentException If all attempts fail
     */
    private function findApiVersion($class)
    {
        if (isset($this->userOptions['apiVersion'])) {
            $version = $this->userOptions['apiVersion'];
        } elseif (!defined("$class::STABLE_VERSION")) {
            throw new \InvalidArgumentException(sprintf(
                    "Cannot decide which API version to use. An `apiVersion' user "
                    . "option was not passed in, and the service\'s STABLE_VERSION "
                    . 'constant was not defined'
            ));
        } else {
            $version = $class::STABLE_VERSION;
        }

        return (float) ltrim($version, 'v');
    }

    private function findDefaultsJsonArray($serviceVersion)
    {
        $defaults = ["TopLevel","Messages"];
        $result = [];
        foreach($defaults as $key) {
            $tmpArray = $this->findJsonArray($key, $serviceVersion);
            $result = array_merge_recursive($result, $tmpArray);
        }
        return $result;        
    }
    
    /**
     * Internal method which returns a service's description array. This array
     * is then passed in to a {@see Description} object for abstraction.
     *
     * This method takes a service name and API version, finds the appropriate
     * Json file in the directory tree, and returns the parsed response.
     *
     * @param string $serviceName    The name of the service
     * @param float  $serviceVersion The version of the service
     *
     * @return array
     * @throws RuntimeException No Json file is found
     */
    private function findJsonArray($serviceName, $serviceVersion)
    {
        $path = sprintf("%s/../../Description/%s/v%.1f.json", __DIR__, ucfirst($serviceName), $serviceVersion);
        if (!file_exists($path)) {
            throw new \RuntimeException(sprintf(
                    "The Json file for this service could not be found: %s", $path
            ));
        }

        return (new JsonDecode(true))->decode(file_get_contents($path), JsonEncoder::FORMAT) ? : [];
    }

}
