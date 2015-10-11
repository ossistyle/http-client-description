<?php

namespace Vws\Test\Integ\WebApi\Delete;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientDeleteProductTest extends ClientAbstractTestCase
{
    use ProductDataProvider;

    /**
     * @dataProvider productDeleteData
     */
    public function testDeleteProductValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->deleteValidation('deleteProduct', $product);
    }

    /**
     * @dataProvider productData
     */
    public function _testPostDeleteProductValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->postDeleteValidation('deleteProduct', $product);
    }
}
