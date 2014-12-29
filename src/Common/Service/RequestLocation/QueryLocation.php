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
 * Description of QueryLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class QueryLocation extends AbstractRequestLocation
{

    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $parameter
    )
    {
        $data = $request->getQuery();
        $this->addValue($data, $parameter, $command);
        $request->setQuery($data);
    }

    public function after(
    CommandInterface $command, RequestInterface $request, Operation $operation
    )
    {
        $additional = $operation->getAdditionalParameters();
        if ($additional && $additional->getLocation() == 'query') {
            foreach ($command->toArray() as $key => $value)
            {
                if (!$operation->hasParam($key)) {
                    $request->getQuery()[$key] = $this->prepareValue($value, $additional);
                }
            }
        }
    }

}
