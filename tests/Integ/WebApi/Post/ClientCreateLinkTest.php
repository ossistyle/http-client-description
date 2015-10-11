<?php

namespace Vws\Test\Integ\WebApi\Post;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

class ClientPostCreateLinkTest extends ClientAbstractTestCase
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
