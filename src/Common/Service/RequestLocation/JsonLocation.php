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
use GuzzleHttp\Stream\Stream;
use Via\Common\Command\CommandInterface;

/**
 * Description of JsonLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class JsonLocation extends AbstractRequestLocation
{

    /**
     * @var array JSON data which will be encoded
     */
    private $jsonData = [];

    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $parameter
    )
    {
        $this->addValue($this->jsonData, $parameter, $command);
    }

    public function after(
    CommandInterface $command, RequestInterface $request, Operation $operation
    )
    {
        $data = $this->jsonData;
        $this->jsonData = [];
// Add additional params to JSON array
        if (($additional = $operation->getAdditionalParameters()) && $additional->getLocation() == 'json') {
            foreach ($command->toArray() as $userKey => $userValue)
            {
                if (!$operation->hasParam($userKey)) {
                    $data[$userKey] = $userValue;
                }
            }
        }
        if (!$request->hasHeader('Content-Type')) {
            $request->setHeader('Content-Type', 'application/json');
        }
        $request->setBody(Stream::factory(json_encode($data)));
    }

}
