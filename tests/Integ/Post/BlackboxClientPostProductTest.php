<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientPostProductTest extends WebApiClientAbstractTestCase
{
    use ProductDataProvider,
        ProductVariationDataProvider;

    /**
     * @dataProvider productData
     */
    public function testPostProductValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->postValidation('postProduct', $product);
    }


    /**
     * @dataProvider productVariationData
     */
    public function testPostProductVariationValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        unset($product['StockAmount']);
        unset($product['Price']);
        $this->postValidation('postProduct', $product);
    }
}
