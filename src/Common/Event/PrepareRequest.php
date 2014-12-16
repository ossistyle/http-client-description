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

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Message\RequestInterface;
use Via\Common\Command\CommandInterface;
use Via\Common\Service\RequestLocation\BodyLocation;
use Via\Common\Service\RequestLocation\HeaderLocation;
use Via\Common\Service\RequestLocation\QueryLocation;
use Via\Common\Service\RequestLocation\JsonLocation;
#use GuzzleHttp\Command\Guzzle\RequestLocation\BodyLocation;
#use GuzzleHttp\Command\Guzzle\RequestLocation\HeaderLocation;
#use GuzzleHttp\Command\Guzzle\RequestLocation\JsonLocation;
#use GuzzleHttp\Command\Guzzle\RequestLocation\QueryLocation;

/**
 * Description of PrepareRequest
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class PrepareRequest implements SubscriberInterface
{

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $httpClient;

    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var \Via\Common\Service\RequestLocation\RequestLocationInterface[]
     */
    private $visitors = [];

    /**
     * @param ClientInterface $httpClient The HTTP client used for network transactions
     * @param array $visitors An optional array of visitor objects. If left empty, defaults
     * are used
     */
    public function __construct(ClientInterface $httpClient, array $visitors = [])
    {
        $this->httpClient = $httpClient;
        $this->visitors = $visitors ? : $this->getDefaultVisitors();
    }

    public function getEvents()
    {
        return [
            'prepare' => ['onPrepare', RequestEvents::EARLY]
        ];
    }

    /**
     * Retrieves a default array of visitor objects if none of provided by the
     * user.
     *
     * @return \Via\Common\Service\RequestLocation\RequestLocationInterface[]
     */
    private function getDefaultVisitors()
    {
        return [
            'body' => new BodyLocation('body'),
            'query' => new QueryLocation('query'),
            'header' => new HeaderLocation('header'),
            'json' => new JsonLocation('json')
        ];
    }

    /**
     * @param CommandInterface $command
     */
    public function setCommand(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param PrepareEvent $event
     */
    public function onPrepare(PrepareEvent $event)
    {
        if ($event->getRequest()) {
            return;
        }
// Retrieve command from event
        $this->setCommand($event->getCommand());
// Create request and set it
        $this->setRequest($this->createRequest());
// Populate request by using visitors and then set back on event
        $this->prepareRequest();
        $event->setRequest($this->request);
    }

    /**
     * Internal method used to create an empty Request object using the URL
     * and HTTP method of the command.
     *
     * @return RequestInterface
     * @throws \RuntimeException
     */
    private function createRequest()
    {
        $operation = $this->command->getName();
        if (null === ($uri = $operation->getUri())) {
            throw new \RuntimeException(sprintf(
                    "The %s operation does not have a URI set", $operation->getName()
            ));
        }
        return $this->httpClient->createRequest(
                        $operation->getHttpMethod(), $this->parseUriTemplate($operation)
        );
    }

    /**
     * Internal method which traverses the list of visitors and "visits" the
     * request object, populating each aspect as it goes along. The fully
     * decorated object is then set on the event which is passed on through
     * the call chain.
     */
    private function prepareRequest()
    {
// Get the REST operation which this request is operating against
        $operation = $this->command->getName();
// Traverse through all the defined parameters for this REST operation
        foreach ($operation->getParams() as $name => $param)
        {
// If the user has not set this input parameter, skip it
            if (!$this->command[$name]) {
                continue;
            }
// If a visitor exists for the location of this parameter, visit
// the request by adding the user value to the request
            $location = $param->getLocation();
            if ($visitor = $this->getVisitor($location)) {
                $visitor->visit($this->command, $this->request, $param, array());
            }
        }
        $visitor->after($this->command, $this->request, $operation, array());
    }

    /**
     * Internal method for retrieving a visitor object based on its location
     * within a request. For example, the "header" location on a request is
     * associated with the {@see Via\Common\Service\RequestLocation\HeaderLocation}
     * class.
     *
     * @param string $name The location you want the visitor for
     *
     * @return false|\Via\Common\Service\RequestLocation\RequestLocationInterface
     */
    private function getVisitor($name)
    {
// Make sure the location is registered. URIs are visited separately.
        if (!isset($this->visitors[$name]) || $name == 'uri') {
            return false;
        }
        return $this->visitors[$name];
    }

    /**
     * For parameters which are associated with the `uri' location, they will
     * need to be inserted into the request URI according to a template pattern.
     * So '{container}/{name}' contains two user-defined values: the container
     * and the name. So if a value is passed in that matches either one, we need
     * to make sure it's stocked into the URI value in a meaningful way.
     *
     * @param Operation $operation
     *
     * @return array
     */
    private function parseUriTemplate(Operation $operation)
    {
        $variables = [];
        foreach ($operation->getParams() as $name => $param)
        {
// Collect params which have URI locations and are defined by user
            if ($param->getLocation() == 'uri' && ($value = $this->command[$name])) {
                $variables[$name] = $param->filter($value);
            }
        }
        return [$operation->getUri(), $variables];
    }

}
