<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

class WebApiClientPostCreateLinkTest extends WebApiClientAbstractTestCase
{
    use ProductCatalogCreateLinkDataProvider;

    /**
     * @dataProvider productCatalogCreateLinkData
     */
    public function testCreateLink($catalogForeignId, $productForeignId, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;
        $this->createLinkValidation(
            'CreateLink',
            [
                'productForeignId' => $productForeignId[0],
                'catalogForeignId' => $catalogForeignId[0]
            ]
        );
    }
}
