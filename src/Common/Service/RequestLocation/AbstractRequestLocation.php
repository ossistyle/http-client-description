<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Service\RequestLocation;

use GuzzleHttp\Command\Guzzle\Operation;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Message\RequestInterface;
use Via\Common\Command\CommandInterface;

/**
 * Description of AbstractRequestLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
abstract class AbstractRequestLocation implements RequestLocationInterface
{

    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $parameter
    )
    {

    }

    public function after(
    CommandInterface $command, RequestInterface $request, Operation $operation
    )
    {
        
    }

    /**
     * @param mixed $value
     * @param Parameter $param
     *
     * @return mixed
     */
    protected function prepareValue($value, Parameter $param)
    {
        return is_array($value) ? $this->resolveRecursively($value, $param) : $param->filter($value);
    }

    /**
     * @param array $value
     * @param Parameter $param
     *
     * @return mixed
     */
    protected function resolveRecursively(array $value, Parameter $param)
    {
        foreach ($value as $name => &$v)
        {
            switch ($param->getType())
            {
                case 'object':
                    if ($subParam = $param->getProperty($name)) {
                        $key = $subParam->getWireName();
                        $value[$key] = $this->prepareValue($v, $subParam);
                        if ($name != $key) {
                            unset($value[$name]);
                        }
                    } elseif ($param->getAdditionalProperties() instanceof Parameter) {
                        $v = $this->prepareValue($v, $param->getAdditionalProperties());
                    }
                    break;
                case 'array':
                    if ($items = $param->getItems()) {
                        $v = $this->prepareValue($v, $items);
                    }
                    break;
            }
        }
        return $param->filter($value);
    }

    protected function addValue(&$array, Parameter $parameter, CommandInterface $command)
    {
        $array[$parameter->getWireName()] = $this->prepareValue(
                $command[$parameter->getName()], $parameter
        );
    }

}
