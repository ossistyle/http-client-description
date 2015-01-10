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

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Via\Common\Command\CommandFactory;

/**
 * Description of AbstractService
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class AbstractService extends GuzzleClient
{
    /**
     * @var CommandFactory
     */
    private $commandFactory;


    public function getCommand($name, array $args = [])
    {
        if (false === ($command = $this->getCommandFactory()->create($name, $args, true))) {
            throw new \InvalidArgumentException("No operation found named $name");
        }

        return $command;
    }

    /**
     * Retrieves the command factory, which is in charge of instantiating new
     * command objects. The factory is returned with lazy loading.
     *
     * @return CommandFactory
     */
    private function getCommandFactory()
    {
        if (null === $this->commandFactory) {
            $this->commandFactory = new CommandFactory($this->getDescription(), $this->getEmitter());
        }

        return $this->commandFactory;
    }

    /**
     * Allows the ability for a custom instance of the factory to be used
     *
     * @param CommandFactory $commandFactory
     */
    public function setCommandFactory(CommandFactory $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }
}
