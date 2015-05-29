<?php

namespace Vws\Test\Integ\Delete;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientDeleteProductTest extends BlackboxClientAbstractTestCase
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
