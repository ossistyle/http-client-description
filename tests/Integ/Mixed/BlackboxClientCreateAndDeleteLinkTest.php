<?php

namespace Vws\Test\Integ\Mixed;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

class BlackboxClientCreateAndDeleteLinkTest extends BlackboxClientAbstractTestCase
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
