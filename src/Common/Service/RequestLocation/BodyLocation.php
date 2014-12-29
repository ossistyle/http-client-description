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

use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Stream\Stream;
#use Via\Common\Command\CommandInterface;
use GuzzleHttp\Command\CommandInterface;

/**
 * Description of BodyLocation
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class BodyLocation extends AbstractRequestLocation
{

    /**
     * {@inheritDoc}
     */
    public function visit(
    CommandInterface $command, RequestInterface $request, Parameter $param
    )
    {
        $value = $command[$param->getName()];
        $request->setBody(Stream::factory($param->filter($value)));
    }

}
