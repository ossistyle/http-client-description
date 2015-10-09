<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

class BlackboxClientPostCreateLinkTest extends BlackboxClientAbstractTestCase
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
