<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Model;

use GuzzleHttp\HasDataTrait;

/**
 * Description of Model
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class Model implements ModelInterface
{

    use HasDataTrait;

    /**
     * @param array $data An array of arbitrary data which this model is supposed to represent
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasKey($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * {@inheritDoc}
     */
    public function merge(array $newData)
    {
        $this->data += $newData;
    }

}
