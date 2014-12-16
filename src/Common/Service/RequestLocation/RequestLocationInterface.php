<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Service\RequestLocation;

use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Message\RequestInterface;
use Via\Common\Command\CommandInterface;

/**
 * Description of RequestLocationInterface
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
interface RequestLocationInterface
{

    /**
     * Visits the request object for every user parameter.
     *
     * @param CommandInterface $command
     * @param RequestInterface $request
     * @param Parameter $parameter
     *
     * @return mixed
     */
    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $parameter
    );

    /**
     * Called when post-configuration or shut down functionality needs to be
     * executed.
     *
     * @param CommandInterface $command
     * @param RequestInterface $request
     * @param Operation $operation
     *
     * @return mixed
     */
    public function after(
    CommandInterface $command, RequestInterface $request, Operation $operation
    );
}
