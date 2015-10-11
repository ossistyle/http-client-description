<?php

namespace Vws\Test\Integ\WebApi\Post;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientPostProductTest extends ClientAbstractTestCase
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
