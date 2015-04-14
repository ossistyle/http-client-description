<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

class BlackboxClientPostCreateLinkTest extends BlackboxClientAbstractTestCase
{
    use ProductCatalogCreateLinkDataProvider;

    /**
     * @dataProvider productCatalogCreateLinkData
     */
    public function _testCreateLink($catalogForeignId, $productForeignId, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;
        $this->validate(
            'CreateLink',
            [
                'productForeignId' => $productForeignId[0],
                'catalogForeignId' => $catalogForeignId[0]
            ]
        );
    }

    /**
     * @dataProvider customAssignment
     */
    public function _testCreateLinkCustomAssignment($catalog, $product, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;

        $this->validate(
            'postProduct',
            $product[0]
        );

        $this->validate(
            'postCatalog',
            $catalog[0]
        );

        $this->validate(
            'CreateLink',
            [
                'productForeignId' => $product[0]['ForeignId'],
                'catalogForeignId' => $catalog[0]['ForeignId']
            ]
        );

        $this->validate(
            'DeleteLink',
            [
                'productForeignId' => $product[0]['ForeignId'],
                'catalogForeignId' => $catalog[0]['ForeignId']
            ]
        );
    }
}
