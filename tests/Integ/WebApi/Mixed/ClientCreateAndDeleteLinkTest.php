<?php

namespace Vws\Test\Integ\WebApi\Mixed;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

class ClientCreateAndDeleteLinkTest extends ClientAbstractTestCase
{
    use ProductCatalogCreateAndDeleteLinkDataProvider;

    /**
     * @dataProvider productCatalogCreateAndDeleteLinkData
     */
    public function testCreateAndDeleteLink($catalogForeignId, $productForeignId, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;
        $this->createAndDeleteLinkValidation(
            [
                'productForeignId' => $productForeignId[0],
                'catalogForeignId' => $catalogForeignId[0]
            ]
        );
    }
}
