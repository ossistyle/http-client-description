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
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
interface ResponseLocationInterface
{

    /**
     * @param ResponseInterface $response
     * @param Parameter $parameter
     * @param ModelInterface $model
     *
     * @return mixed
     */
    public function before(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    );

    /**
     * @param ResponseInterface $response
     * @param Parameter $parameter
     * @param ModelInterface $model
     *
     * @return mixed
     */
    public function visit(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    );

    /**
     * @param ResponseInterface $response
     * @param Parameter $parameter
     * @param ModelInterface $model
     *
     * @return mixed
     */
    public function after(
    ResponseInterface $response, Parameter $parameter, ModelInterface $model
    );
}
