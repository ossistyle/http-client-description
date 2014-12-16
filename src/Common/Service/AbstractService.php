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

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Event\HasEmitterTrait;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Url;
use GuzzleHttp\Command\Event\InitEvent;
use Via\Common\Command\CommandFactory;
use Via\Common\Command\CommandInterface;
use Via\Common\Command\CommandManager;
use Via\Common\Exception\CommandException;
use Via\Common\Iterator\CommandToRequestIterator;
use Via\Common\Iterator\ResourceIterator;
use GuzzleHttp\Command\CommandTransaction;

/**
 * Description of AbstractService
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class AbstractService implements ServiceInterface
{

    use HasEmitterTrait;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $httpClient;

    /**
     * @var CommandFactory
     */
    private $commandFactory;

    /**
     * @var \GuzzleHttp\Command\Guzzle\Description
     */
    private $description;

    /**
     * @var WildcardParserInterface
     */
    private $wildcardParser;

    /**
     * @param ClientInterface $httpClient The HTTP client responsible for
     * handling HTTP transactions.
     * @param Description $description The description which define all the
     * possible services this client can invoke
     * and execute.
     */
    public function __construct(
    ClientInterface $httpClient, Description $description
    )
    {
        $this->httpClient = $httpClient;
        $this->description = $description;
    }

    public function getName()
    {
        return $this->getDescription()->getData('name');
    }

    public function getType()
    {
        return $this->getDescription()->getData('type');
    }

    public function getDescription()
    {
        return $this->description;
    }

    protected function getWildcardParser()
    {
        if (!$this->wildcardParser) {
            throw new \RuntimeException('No wildcard parser set');
        }
        return $this->wildcardParser;
    }

    public function setWildcardParser(WildcardParserInterface $parser)
    {
        $this->wildcardParser = $parser;
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

    public function __call($name, array $arguments)
    {
        return $this->execute(
                        $this->getCommand($name, isset($arguments[0]) ? $arguments[0] : [])
        );
    }

    public function getCommand($name, array $args = [])
    {
        if (false === ($command = $this->getCommandFactory()->create($name, $args, true))) {
            throw new \InvalidArgumentException("No operation found named $name");
        }

        return $command;
    }

    public function getIterator($name, array $args = [])
    {
        $command = $this->getCommand($name, $args);
        $options = $command->getOperation()->getData('iterator') ? : [];
        return new ResourceIterator($this, $command, $options);
    }

    public function execute(CommandInterface $command)
    {
        try {

            #$trans = new CommandTransaction($this, $command);
            #$command->getEmitter()->emit('init', new InitEvent($trans));
// Set up command manager and processed request
            $manager = new CommandManager($command);
            $request = $manager->prepareRequest();
// Send request to server
            $response = $this->httpClient->send($request);
// Process the response
            return $manager->processResponse($response);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            throw new CommandException($e->getRequest(), $this, $command, null, null, $e);
        } catch (RequestException $e) {
            //$e = $e->getPrevious();
            throw new CommandException($e->getMessage(), $this, $command, $e->getRequest(), $e->getResponse()
            );
        } catch (\Exception $e) {
            $msg = 'Error executing command: ' . $e->getMessage();
            throw new CommandException($msg, $this, $command, null, null, $e);
        }
    }

    public function executeAll($commands, array $options = [])
    {
        $failures = [];
        $successes = [];
        $responses = [];
// Define how events are handled
        $config = [
            'error' => [
                'priority' => RequestEvents::EARLY + 1,
                'fn' => function (ErrorEvent $e) use (&$failures, &$responses)
                {
// S
                    $e->stopPropagation();
                    $path = Url::fromString($e->getRequest()->getUrl())->getPath();
                    $failures[] = $path;
                    $responses[$path] = $e->getResponse();
                }
            ],
            'complete' => [
                'priority' => RequestEvents::EARLY + 1,
                'fn' => function (CompleteEvent $e) use (&$successes, &$responses)
                {
                    $response = $e->getResponse();
                    if ($response->getStatusCode() >= 400) {
                        return;
                    }
                    $path = Url::fromString($e->getRequest()->getUrl())->getPath();
                    $successes[] = $path;
                    $responses[$path] = $response;
                }
            ]
        ];
// Ensure that as commands are iterated over, they're converted into requests
        $requests = new CommandToRequestIterator(new \ArrayIterator($commands), array_merge($options, $config));
// Send the requests in parallel and aggregate the results.
        $this->httpClient->sendAll($requests, $options);
        return [
            'successes' => $successes,
            'failures' => $failures,
            'responses' => $responses
        ];
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    protected function mapOverParts($string, callable $objectFn = null, callable $containerFn = null)
    {
        $parts = $this->getWildCardParser()->parse($string);
        foreach ($parts as $containerName => $objectNames)
        {
            if (is_array($objectNames)) {
                foreach ($objectNames as $objectName)
                {
                    if (is_callable($objectFn)) {
                        call_user_func($objectFn, $containerName, $objectName);
                    }
                }
            } elseif ($objectNames === true) {
                if (is_callable($containerFn)) {
                    call_user_func($containerFn, $containerName);
                }
            }
        }
    }
}
