<?php

namespace Vws\Test\Integ\WebApi\Mixed;

use GuzzleHttp\Collection;

trait ProductCatalogCreateAndDeleteLinkDataProvider
{
    public static function productCatalogCreateAndDeleteLinkData()
    {
        return array_merge(
            self::createAndDeleteLink()
        );
    }

    public static function createAndDeleteLink()
    {
        return
        [
            [
                [
                    'root_patch_products'
                ],
                [
                    'patch_standard_product'
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ]
            ]
        ];
    }
}
