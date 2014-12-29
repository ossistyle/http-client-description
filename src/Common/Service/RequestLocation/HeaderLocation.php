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
#use Via\Common\Command\CommandInterface;
use GuzzleHttp\Command\CommandInterface;

/**
 * Description of HeaderLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class HeaderLocation extends AbstractRequestLocation
{

    /**
     * {@inheritDoc}
     */
    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $parameter
    )
    {
        $userValue = $command[$parameter->getName()];
        if (!$userValue) {
            return;
        }
        if (preg_match('#metadata#i', $parameter->getName())) {
            foreach ($userValue as $key => $value)
            {
                $title = sprintf("%s%s", $parameter->getData('prefix') ? : '', $key);
                $value = $this->filterValue($parameter, $value);
                $request->setHeader($title, $value);
            }
        } else {
            $request->setHeader($parameter->getWireName(), $this->filterValue($parameter, $userValue));
        }
    }

    /**
     * Filters a value using normal means, but also makes sure that boolean
     * values are converted into strings properly.
     *
     * @param Parameter $parameter
     * @param mixed $value
     *
     * @return mixed|string
     */
    private function filterValue(Parameter $parameter, $value)
    {
        $value = $parameter->filter($value);
        if ($parameter->getType() == 'boolean' && is_bool($value)) {
            $value = ($value === true) ? 'true' : 'false';
        }
        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function after(
    CommandInterface $command, RequestInterface $request, Operation $operation
    )
    {
        $additional = $operation->getAdditionalParameters();
        if ($additional && $additional->getLocation() == 'header') {
            foreach ($command->toArray() as $key => $value)
            {
                if (!$operation->hasParam($key)) {
                    $request->setHeader($key, $additional->filter($value));
                }
            }
        }
    }

}
