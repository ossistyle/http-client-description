<?php

namespace Vws\Test\Integ\Get;

use Vws\Test\Integ\WebApiClientAbstractTestCase;
use Vws\Test\Integ\IntegUtils;

/**
 *
 */
class WebApiClientGetSalesOrderTest extends WebApiClientAbstractTestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetSalesOrdersProductIdIsNotNull()
    {
        $client = $this->createClient();
        $response = $client->getNewSalesOrders();

        // ProductId is null
        $this->assertSame(
            0,
            count(array_filter($response->search('EntityList[].SalesOrderItems[?ProductId==`null`].Id'))),
            'SalesOrder with empty ProductId returned'
        );
    }

    /**
     *
     */
    public function testGetSalesOrdersForeignOrderIdIsNotNull()
    {
        $client = $this->createClient();
        $response = $client->getNewSalesOrders();

        // ForeignOrderId is not null
        $this->assertSame(
            0,
            count(array_filter($response->search('EntityList[?ForeignOrderId!=`null`].Id'))),
            'SalesOrder with not empty ForeignOrderId returned'
        );
    }

    /**
     *
     */
    public function testGetSalesOrdersCheckoutStatusIsCompleted()
    {
        $client = $this->createClient();
        $response = $client->getNewSalesOrders();

        // CheckoutStatus is zero
        $this->assertSame(
            0,
            count(array_filter($response->search('EntityList[?CheckoutStatus==`0`].Id'))),
            'SalesOrder with CheckoutStatus not completed (0) returned'
        );
    }
}
