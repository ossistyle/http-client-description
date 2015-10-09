<?php

namespace Vws\Test\Integ\Patch;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientSalesOrdersTest extends WebApiClientAbstractTestCase
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
