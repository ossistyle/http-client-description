<?php

namespace Vws\Test\Integ\WebApi\Delete;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

class ClientDeleteLinkTest extends ClientAbstractTestCase
{
    use ProductCatalogDeleteLinkDataProvider;

    /**
     * @dataProvider productCatalogDeleteLinkData
     */
    public function testDeleteLink($catalogForeignId, $productForeignId, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;
        $this->deleteLinkValidation(
            'DeleteLink',
            [
                'productForeignId' => $productForeignId[0],
                'catalogForeignId' => $catalogForeignId[0]
            ]
        );
    }
}
