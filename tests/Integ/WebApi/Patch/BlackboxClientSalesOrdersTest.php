<?php

namespace Vws\Test\Integ\WebApi\Patch;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientSalesOrdersTest extends ClientAbstractTestCase
{
    use SalesOrdersDataProvider;

    /**
     * @dataProvider salesOrdersData
     */
    public function testPatchSalesOrdersValidation(
        $salesOrder,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;

        $this->patchValidation(
            'patchSalesOrders',
            $salesOrder
        );
    }
}
