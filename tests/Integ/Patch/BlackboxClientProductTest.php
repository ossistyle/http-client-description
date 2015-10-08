<?php

namespace Vws\Test\Integ\Patch;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientProductTest extends WebApiClientAbstractTestCase
{
    use ProductDataProvider;

    /**
     * @dataProvider productData
     */
    public function testPatchProductValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;

        $this->patchValidation(
            'patchProduct',
            $product
        );
    }
}
