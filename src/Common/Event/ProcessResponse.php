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

use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Event\SubscriberInterface;
use Via\Common\Model\Model;
use Via\Common\Service\ResponseLocation\BodyLocation;
use Via\Common\Service\ResponseLocation\HeaderLocation;
use Via\Common\Service\ResponseLocation\JsonLocation;

/**
 * Description of ProcessResponse
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class ProcessResponse implements SubscriberInterface
{

    /**
     * @var \GuzzleHttp\Message\ResponseInterface
     */
    private $response;

    /**
     * @var \Via\Common\Service\ResponseLocation\ResponseLocationInterface[]
     */
    private $visitors = [];

    /**
     * @var \OpenStack\Common\Model\ModelInterface
     */
    private $model;

    /**
     * @var \GuzzleHttp\Command\Guzzle\Parameter
     */
    private $modelSchema;
    private $invokedLocations = [];

    /**
     * @param array $visitors An array of {@see Via\Common\Service\ResponseLocation\ResponseLocationInterface}
     * objects. Optional; if none are specified, defaults are used
     */
    public function __construct(array $visitors = [])
    {
        $this->visitors = $visitors ? : $this->getDefaultVisitors();
    }

    public function getEvents()
    {
        return [
            'process' => ['onProcess']
        ];
    }

    /**
     * Retrieves a default array of visitor objects if none of provided by the
     * user.
     *
     * @return \Via\Common\Service\ResponseLocation\ResponseLocationInterface[]
     */
    private function getDefaultVisitors()
    {
        return [
            'header' => new HeaderLocation(),
            'body' => new BodyLocation(),
            'json' => new JsonLocation()
        ];
    }

    /**
     * @param ProcessEvent $event
     */
    public function onProcess(ProcessEvent $event)
    {
        $operation = $event->getOperation();
// Allow operations with no defined response model to return quickly
        if (null === ($modelName = $operation->getResponseModel())) {
            return;
        }
// Get the response that has been received from the server
        $this->response = $event->getResponse();
// Instantiate new model object
        $this->model = new Model();
        /** @var \GuzzleHttp\Command\Guzzle\Parameter */
        $this->modelSchema = $operation->getServiceDescription()->getModel($modelName);
// Now that we have the HTTP response and an empty model, use the
// schema to populate everything
        $this->populateModel();
// Set result on the event and allow it to continue its journey down the chain
        $event->setResult($this->model);
    }

    /**
     * Populate the model according to a schema.
     *
     * @throws \RuntimeException Only objects and arrays can be parsed into a
     * model object, since they rely on a key/value
     * based access system. So if a schema is used
     * has any other type (string, int, bool, etc) then
     * an exception is raised
     */
    private function populateModel()
    {
        $type = $this->modelSchema->getType();
        if ($type == 'object') {
            $this->processObject();
        } elseif ($type == 'array') {
            $this->processArray();
        } else {
            throw new \RuntimeException(
            "Only models with an 'object' or 'array' type can be parsed"
            );
        }
// Traverse all the visitors that have been invoked and call their `after' method
// This is useful when setting values that rely on a previously set value
        $this->invokeVisitorShutdown();
    }

    /**
     * Internal method that processes an object type.
     */
    private function processObject()
    {
        $this->setupVisitorsForObject();
        foreach ($this->modelSchema->getProperties() as $schema)
        {
            if ($location = $schema->getLocation()) {
                $this->visit($location, $schema);
            }
        }
    }

    /**
     * Internal method that processes an array type.
     */
    private function processArray()
    {
        if (!($location = $this->modelSchema->getLocation())) {
            return;
        }
        $this->invokeVisitorSetup($location);
        $this->visit($location);
    }

    private function visit($location, Parameter $schema = null)
    {
        if (!isset($this->visitors[$location])) {
            throw new \RuntimeException("Unknown location: {$location}");
        }
        $this->visitors[$location]->visit(
                $this->response, $schema ? : $this->modelSchema, $this->model
        );
    }

    /**
     * Traverse the response model to figure out which locations are going to be
     * used. Once this list is compiled, call the `startup' method on the visitor
     * associated with each location. So if a responseModel is an object with
     * two properties, and each property has a different location, then two
     * visitors will be setup.
     */
    private function setupVisitorsForObject()
    {
        $locations = [];
        $additional = $this->modelSchema->getAdditionalProperties();
        if ($additional instanceof Parameter) {
            $locations[$additional->getLocation()] = true;
        }
        foreach ($this->modelSchema->getProperties() as $schema)
        {
            $locations[$schema->getLocation()] = true;
        }
        foreach ($locations as $location => $val)
        {
            $this->invokeVisitorSetup($location);
        }
    }

    /**
     * @param $location
     *
     * @throws \RuntimeException
     */
    private function invokeVisitorSetup($location)
    {
        if (!isset($this->visitors[$location])) {
            throw new \RuntimeException("Unknown location: $location");
        }
        if (isset($this->invokedLocations[$location])) {
            return;
        }
        $this->invokedLocations[$location] = true;
        $this->visitors[$location]->before(
                $this->response, $this->modelSchema, $this->model
        );
    }

    /**
     * Go through all the visitors that have been invoked (each one is saved in
     * a local cache once) and call their `after' method. For visitors that
     * have been used multiple times, they will only be saved once in the cache.
     */
    private function invokeVisitorShutdown()
    {
        $visitorNames = array_keys($this->invokedLocations);
        foreach ($visitorNames as $visitorName)
        {
            $this->visitors[$visitorName]->after(
                    $this->response, $this->modelSchema, $this->model
            );
        }
    }

}
