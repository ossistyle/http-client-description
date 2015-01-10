<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Exception;

use GuzzleHttp\Command\Exception\CommandException as GuzzleCommandException;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Via\Common\Command\CommandInterface;
use Via\Common\Service\ServiceInterface;

/**
 * Description of CommandException
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class CommandException extends \RuntimeException
{

    /** @var ClientInterface */
    private $client;

    /** @var CommandInterface */
    private $command;

    /**
     * @param string $message Exception message
     * @param ServiceInterface $client Client that sent the command
     * @param CommandInterface $command Command that failed
     * @param RequestInterface $request Request that was sent
     * @param ResponseInterface $response Response that was received
     * @param \Exception $previous Previous exception (if any)
     */
    public function __construct(
    $message, ServiceInterface $client, CommandInterface $command, RequestInterface $request = null, ResponseInterface $response = null, \Exception $previous = null
    )
    {
        $this->client = $client;
        $this->command = $command;
        $this->request = $request;
        $this->response = $response;
        parent::__construct($message, 0, $previous);
    }

    /**
     * Get the client associated with the command exception
     *
     * @return ServiceClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get the command that was transferred.
     *
     * @return CommandInterface
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Get the request associated with the command or null if one was not sent.
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get the response associated with the command or null if one was not
     * received.
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }

}
