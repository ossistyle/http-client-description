<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Command;

use GuzzleHttp\Message\ResponseInterface;
use Via\Common\Event\PrepareEvent;
use Via\Common\Event\ProcessEvent;
use Via\Common\Transport\ExceptionHandler;

/**
 * Description of CommandManager
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class CommandManager
{

    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * Method responsible for preparing a command and serializing it into a
     * {@see GuzzleHttp\Message\RequestInterface} to be sent across the network.
     *
     * @param PrepareEvent $event Optional event object that will be emitted to
     * subscribers.
     *
     * @return \GuzzleHttp\Message\RequestInterface
     * @throws \RuntimeException
     */
    public function prepareRequest(PrepareEvent $event = null)
    {
// Dispatch prepare event, which will return a fully decorated request
        $event = $event ? : new PrepareEvent($this->command);
        $this->command->getEmitter()->emit('prepare', $event);
        if (!($request = $event->getRequest())) {
            throw new \RuntimeException('Request was not created by prepare subscribers');
        }
// Attach exception handler
        //$request->getEmitter()->attach(new ExceptionHandler($this->command));
        return $request;
    }

    /**
     * Method responsible for parsing a {@see GuzzleHttp\Message\ResponseInterface}
     * object returned from a server into a user-friendly
     * {@see Via\Common\Model\ModelInterface}
     *
     * @param ResponseInterface $response The response returned from the server
     * @param ProcessEvent $event Optional event object that will be
     * emitted to subscribers.
     *
     * @return ModelInterface|ResponseInterface
     */
    public function processResponse(ResponseInterface $response, ProcessEvent $event = null)
    {
// Dispatch process event, which will parse HTTP response into a model
        //$event = $event ? : new ProcessEvent($this->command->getOperation(), $response);
        $event = $event ? : new ProcessEvent($this->command->getName(), $response);
        $this->command->getEmitter()->emit('process', $event);
// and return the finished product
        return $event->getResult() ? : $event->getResponse();
    }

}
