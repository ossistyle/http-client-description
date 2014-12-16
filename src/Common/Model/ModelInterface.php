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

#use GuzzleHttp\Command\ModelInterface as GuzzleModelInterface;

/**
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
interface ModelInterface #extends GuzzleModelInterface
{

    /**
     * @param array $newData An array which you want to append to the internal data already held by this model
     *
     * @return void
     */
    public function merge(array $newData);
}
