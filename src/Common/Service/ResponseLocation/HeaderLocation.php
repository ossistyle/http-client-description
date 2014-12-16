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
 * Description of HeaderLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class HeaderLocation extends AbstractResponseLocation
{

    /**
     * {@inheritDoc}
     */
    public function visit(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    )
    {
        $name = $parameter->getName();
        if ($name == 'Metadata') {
            $prefix = $parameter->getData('prefix');
            foreach ($response->getHeaders() as $key => $values)
            {
                if (strpos($key, $prefix) === 0) {
                    $stripped = str_replace($prefix, '', $key);
                    $inner = $model[$name];
                    $inner[$stripped] = $parameter->filter($values[0]);
                    $model[$name] = $inner;
                }
            }
        } elseif ($response->hasHeader($parameter->getWireName())) {
            $model[$name] = $parameter->filter(
                    $response->getHeader($parameter->getWireName())
            );
        }
    }

}
