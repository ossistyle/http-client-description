<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Event;

use GuzzleHttp\Event\AbstractEvent;
use GuzzleHttp\Message\RequestInterface;
use Via\Common\Auth\Catalog;
use Via\Common\Command\CommandInterface;

/**
 * Description of PrepareEvent
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class PrepareEvent extends AbstractEvent
{

    /**
     * @var \GuzzleHttp\Message\RequestInterface
     */
    private $request;

    /**
     * @var Catalog
     */
    private $catalog;

    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @param CommandInterface $command The command that encapsulates the process
     * of serializing a request and parsing
     * a model
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Catalog $catalog
     */
    public function setCatalog(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * @return Catalog
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

}
