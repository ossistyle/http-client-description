<?php

namespace Vws\Test\Integ;

use Vws\Test\Integ\WebApiClientAbstractTestCase;
use GuzzleHttp\Command\Event\ProcessEvent;

/**
 * @internal
 */
class WebApiClientProductConcurrencyTest extends WebApiClientAbstractTestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetProductParallelRequest10()
    {
        $commands = [
            $this->client->getCommand('GetProducts', ['page' => 1]),
            $this->client->getCommand('GetProducts', ['page' => 2]),
            $this->client->getCommand('GetProducts', ['page' => 3]),
            $this->client->getCommand('GetProducts', ['page' => 4]),
            $this->client->getCommand('GetProducts', ['page' => 5]),
            $this->client->getCommand('GetProducts', ['page' => 6]),
            $this->client->getCommand('GetProducts', ['page' => 7]),
            $this->client->getCommand('GetProducts', ['page' => 8]),
            $this->client->getCommand('GetProducts', ['page' => 9]),
            $this->client->getCommand('GetProducts', ['page' => 10]),
        ];

        $processResults = [];
        $this->client->executeAll($commands, [
            'process' => function (ProcessEvent $e) use (&$processResults) {
                $processResults[] = $e->getResult();
            },
        ]);

        // fetch all ForeignIds
        $results = \JmesPath\search('[*].EntityList[*].ForeignId', $processResults);

        $tmpResults = [];
        foreach ($results as $result) {
            $tmpResults = array_merge($tmpResults, $result);
        }
        // set values (ForeignIds) as array key
        $actual = array_flip($tmpResults);

        $this->assertArrayHasKey('KS8803101', $actual);
        $this->assertArrayHasKey('SO6002816', $actual);
        $this->assertArrayHasKey('KK10C02701', $actual);
        $this->assertArrayHasKey('SJW237106', $actual);
        $this->assertCount(1000, $actual);
    }

    /**
     *
     */
    public function testPostProductParallelRequests10AndDeleteProductParallelRequests10()
    {
        $this->markTestIncomplete('Post Product parallel 10 requests and Delete Product parallel NOT IMPLEMENTED YET');
        // $commands = [
        //     $this->client->getCommand('PostProduct', [
        //         'ForeignId' => '',
        //         'Title' => '',
        //         'Description' => '',
        //         'ShortDescription' => '',
        //         'Price' => 1.23,
        //         'Ean' => 'abc123',
        //         'StockAmount' => 1,
        //     ]),
        // ];
        //
        // $processResults = [];
        // $this->client->executeAll($commands, [
        //     'process' => function (ProcessEvent $e) use (&$processResults) {
        //         $processResults[] = $e->getResult();
        //     },
        // ]);
    }
}
