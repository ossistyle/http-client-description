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

use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Ring\Future\FutureInterface;
use Via\Common\Command\CommandFactory;
use Via\Common\Exception\CommandException;

/**
 * Description of AbstractService
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class AbstractService extends GuzzleClient implements ServiceInterface
{
    /**
     * @var CommandFactory
     */
    private $commandFactory;

    public function getName()
    {
        return $this->getDescription()->getName();
    }

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
    
    public function getIterator($name, array $args = [])
    {
        $command = $this->getCommand($name, $args);

        $options = $command->getOperation()->getData('iterator') ?: [];

        return new ResourceIterator($this, $command, $options);
    }
    
    public function execute(CommandInterface $command)
    {
        $trans = $this->initTransaction($command);

        if ($trans->result !== null) {
            return $trans->result;
        }

        try {
            $trans->response = $this->getHttpClient()->send($trans->request);
            return $trans->response instanceof FutureInterface
                ? $this->createFutureResult($trans)
                : $trans->result;
        } catch (RequestException $e) {
            $e = $e->getPrevious();
            throw new CommandException($e->getMessage(), $this, $command,
                $e->getRequest(), $e->getResponse()
            );
        } catch (\Exception $e) {
            $msg = 'Error executing command: ' . $e->getMessage();
            throw new CommandException($msg, $this, $command, null, null, $e);
        }
    }
}
