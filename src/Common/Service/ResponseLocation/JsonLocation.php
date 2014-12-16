<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Service\ResponseLocation;

use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Message\ResponseInterface;
use Via\Common\Model\ModelInterface;

/**
 * Description of JsonLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class JsonLocation extends AbstractResponseLocation
{

    /**
     * @var array
     */
    private $jsonData = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->jsonData = $data;
    }

    /**
     * {@inheritDoc}
     */
    public function before(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    )
    {
        $this->jsonData = (array) $response->json() ? : [];
    }

    /**
     * {@inheritDoc}
     */
    public function visit(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    )
    {
        $this->visitData($parameter, $model);
    }

    /**
     * @param Parameter $parameter
     * @param ModelInterface $model
     */
    public function visitData(Parameter $parameter, ModelInterface $model)
    {
        $name = $parameter->getName();
        $key = $parameter->getWireName();
        if ($parameter->getType() == 'array') {
// All the remaining data parsed from the JSON body
            $walkedData = $this->recurse($parameter, $this->jsonData);
            if ($name) {
// If a key is defined, set all the remaining data onto that key
                $model->offsetSet($name, $walkedData);
            } else {
// otherwise just merge it into the whole model structure
                $model->merge($walkedData);
            }
        } elseif (isset($this->jsonData[$key])) {
            $model->offsetSet($name, $this->recurse($parameter, $this->jsonData[$key]));
        } elseif ($parameter->getType() == 'object') {
            $walkedData = $this->recurse($parameter, $this->jsonData);
            $model->merge($walkedData);
        }
    }

    /**
     * @param Parameter $parameter
     * @param $value
     *
     * @return mixed
     */
    private function recurse(Parameter $parameter, $value)
    {
        $result = [];
        $type = $parameter->getType();
        if ($type == 'array') {
// For arrays, each element will be parsed by a schema defined in
// the description. In other words, the array needs to be homogeneous.
            if ($schema = $parameter->getItems()) {
                foreach ($value as $element)
                {
                    $result[] = $this->recurse($schema, $element);
                }
            }
        } elseif ($type == 'object') {
// For objects, each property defines its own structure. So 1 element
// could be a simple string, another could be an array, and another
// could be a nested object. So we need to traverse all the way down
// into the object structure, parse each level, and then return up the chain
            foreach ($parameter->getProperties() as $property)
            {
                $key = $property->getWireName();
                if (isset($value[$key])) {
                    $name = $property->getName();
                    $result[$name] = $this->recurse($property, $value[$key]);
                    unset($value[$key]);
                }
            }
// Are there any values left in the JSON? If so, does the description
// allow us to treat them as additionalProperties?
            if (count($value) && ($additional = $parameter->getAdditionalProperties())) {
                if ($additional === true) {
// If we're being permissive in our description, just merge everything
                    $result += $value;
                } elseif ($additional instanceof Parameter) {
// If we want the data to abide by some arbitrary structure
                    foreach ($value as $name => $element)
                    {
                        $result[$name] = $this->recurse($additional, $element);
                    }
                }
            }
        } else {
// If it's not an object or an array, i.e. if it is a flat value,
// there is no need to recurse further
            $result = $value;
        }
// Filter and return the result
        return $parameter->filter($result);
    }

}
