<?php

namespace Vws\Test\Integ\Patch;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientProductTest extends BlackboxClientAbstractTestCase
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
