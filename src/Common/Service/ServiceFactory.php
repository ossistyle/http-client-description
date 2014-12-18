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
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Yaml\Parser;
use Via\Common\Event\AuthHandler;
use Via\Common\Event\PrepareRequest;
use Via\Common\Enum\EndPoint;

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
        foreach ($requiredOptions as $requiredOption)
        {
            if (empty($this->userOptions[$requiredOption])) {
                $missing[] = $requiredOption;
            }
        }
        if (count($missing)) {
            throw new InvalidArgumentException(sprintf(
                    "These required options are either not set or empty: %s", implode(', ', $missing)
            ));
        }
        $defaults = ['base_url' => EndPoint::SANDBOX_URL_TYPE];
        foreach ($defaults as $key => $val)
        {
            if (empty($this->userOptions[$key])) {
                $this->userOptions[$key] = $val;
            }
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
    public function mergeOptions(array $options)
    {
        $this->userOptions = array_merge($this->userOptions, $options);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->userOptions;
    }

    /**
     * Creates a new service object. It takes a name, finds its FQCN and injects
     * all the required dependencies.
     *
     * @param string $serviceName The case-insensitive name of the service. This
     * is the human-readable version of the Via
     * service, not a codename.
     *
     * @param array $options Optional configuration options specific to
     * this service. These are merged with the
     * pre-existing options.
     *
     * @return mixed
     * @throws InvalidArgumentException If the service class cannot be found
     */
    public function create($serviceName, array $options = [])
    {
        if (count($options)) {
            $this->mergeOptions($options);
        }
        $this->validateOptions();
        $class = sprintf("Via\\%s\\Service", ucfirst($serviceName));

        if (!class_exists($class)) {
            throw new InvalidArgumentException(sprintf("%s does not exist", $class));
        }
        if (!$this->httpClient) {
//$options = array_merge_recursive($this->userOptions, ['defaults' => ['exceptions' => false]]);
            $options = $this->userOptions;
            $this->setHttpClient(new Client($options));
        }
        if (!$this->description) {
            $array = $this->findJsonArray($serviceName, $this->findApiVersion($class));
            $this->setDescription(new Description($array));
        }

        $service = new $class($this->httpClient, $this->description, $this->userOptions);

        $parserClass = sprintf('Via\\%s\\WildcardParser', ucfirst($serviceName));
        if (class_exists($parserClass)) {
            $service->setWildcardParser(new $parserClass($service));
        }
        $this->userOptions += [
            'serviceName' => $service->getName(),
            'serviceType' => $service->getType()
        ];
        foreach ($this->getHandlers() as $handler)
        {
            $service->getEmitter()->attach($handler);
        }
        return $service;
    }

    private function getHandlers()
    {
        return [
            //new ValidateInput($this->description),
            new PrepareRequest(clone $this->httpClient),
            new AuthHandler(clone $this->httpClient, $this->userOptions),
                //new BaseUrlHandler($this->userOptions),
                //new ProcessResponse()
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
            throw new InvalidArgumentException(sprintf(
                    "Cannot decide which API version to use. An `apiVersion' user "
                    . "option was not passed in, and the service\'s STABLE_VERSION "
                    . 'constant was not defined'
            ));
        } else {
            $version = $class::STABLE_VERSION;
        }
        return (float) ltrim($version, 'v');
    }

    /**
     * Internal method which returns a service's description array. This array
     * is then passed in to a {@see Description} object for abstraction.
     *
     * This method takes a service name and API version, finds the appropriate
     * YAML file in the directory tree, and returns the parsed response.
     *
     * @param string $serviceName The name of the service
     * @param float $serviceVersion The version of the service
     *
     * @return array
     * @throws RuntimeException No YAML file is found
     */
    private function findYamlArray($serviceName, $serviceVersion)
    {
        $path = sprintf("%s/../../%s/Description/v%.1f.yml", __DIR__, ucfirst($serviceName), $serviceVersion);
        if (!file_exists($path)) {
            throw new RuntimeException(sprintf(
                    "The YAML file for this service could not be found: %s", $path
            ));
        }
        return (new Parser())->parse(file_get_contents($path)) ? : [];
    }

    /**
     * Internal method which returns a service's description array. This array
     * is then passed in to a {@see Description} object for abstraction.
     *
     * This method takes a service name and API version, finds the appropriate
     * Json file in the directory tree, and returns the parsed response.
     *
     * @param string $serviceName The name of the service
     * @param float $serviceVersion The version of the service
     *
     * @return array
     * @throws RuntimeException No Json file is found
     */
    private function findJsonArray($serviceName, $serviceVersion)
    {
        $path = sprintf("%s/../../%s/Description/v%.1f.json", __DIR__, ucfirst($serviceName), $serviceVersion);
        if (!file_exists($path)) {
            throw new RuntimeException(sprintf(
                    "The Json file for this service could not be found: %s", $path
            ));
        }
        return (new JsonDecode(true))->decode(file_get_contents($path), JsonEncoder::FORMAT) ? : [];
    }

}
