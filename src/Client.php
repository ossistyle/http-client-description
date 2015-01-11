<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via;

use Via\Common\Service\ServiceFactory;

/**
 * Description of Client
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class Client
{

    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options User-defined options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $name The human-readable name of the service you are
     *                     trying to instantiate. Code-names are not valid
     *
     *
     * @return \GuzzleHttp\Command\ServiceClientInterface
     */
    public function getService($name)
    {
        $factory = new ServiceFactory($this->options);

        return $factory->create($name);
    }

    public function hasService($name)
    {
        return class_exists(sprintf('Via\\%s\\Service', ucfirst($name)));
    }

    /**
     * Magic method that allows for short-hand service creation
     *
     * @see getService
     */
    public function __call($serviceName, $args)
    {
        return $this->getService($serviceName, $args);
    }

}
