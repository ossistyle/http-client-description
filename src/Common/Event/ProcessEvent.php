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

use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Event\AbstractEvent;
use GuzzleHttp\Message\ResponseInterface;
use Via\Common\Model\ModelInterface;

/**
 * Description of ProcessEvent
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class ProcessEvent extends AbstractEvent
{

    /**
     * @var Operation
     */
    private $operation;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var ModelInterface
     */
    private $result;

    /**
     * @param Operation $operation The operation which determines how
     * the model will be structured. Useful
     * to think of it like a schema
     * @param ResponseInterface $response The HTTP response which is being
     * parsed into a model
     */
    public function __construct(Operation $operation, ResponseInterface $response)
    {
        $this->operation = $operation;
        $this->response = $response;
    }

    public function getEvents()
    {
        return [
            'process' => ['onProcess']
        ];
    }

    /**
     * @return Operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ModelInterface $model
     */
    public function setResult(ModelInterface $model)
    {
        $this->result = $model;
    }

    /**
     * @return ModelInterface
     */
    public function getResult()
    {
        return $this->result;
    }

}
