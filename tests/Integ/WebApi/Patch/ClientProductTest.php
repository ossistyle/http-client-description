<?php

namespace Vws\Test\Integ\WebApi\Patch;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientProductTest extends ClientAbstractTestCase
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
