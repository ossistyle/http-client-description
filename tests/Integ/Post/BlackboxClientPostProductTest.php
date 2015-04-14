<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientPostProductTest extends BlackboxClientAbstractTestCase
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
        //unset($product['StockAmount']);
        //unset($product['Price']);
        $product['StockAmount'] = 1;
        $product['Price'] = 1.23;
        $this->postValidation('postProduct', $product);
    }
}
