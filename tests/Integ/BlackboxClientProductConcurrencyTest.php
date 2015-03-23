<?php

namespace Vws\Test\Integ;

use Vws\Sdk;
use GuzzleHttp\Command\Event\ProcessEvent;

/**
 *
 */
class BlackboxClientProductConcurrencyTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetProductParallelRequest10 ()
    {

        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);

        $commands = [
            $client->getCommand('GetProducts', ['page' => 1]),
            $client->getCommand('GetProducts', ['page' => 2]),
            $client->getCommand('GetProducts', ['page' => 3]),
            $client->getCommand('GetProducts', ['page' => 4]),
            $client->getCommand('GetProducts', ['page' => 5]),
            $client->getCommand('GetProducts', ['page' => 6]),
            $client->getCommand('GetProducts', ['page' => 7]),
            $client->getCommand('GetProducts', ['page' => 8]),
            $client->getCommand('GetProducts', ['page' => 9]),
            $client->getCommand('GetProducts', ['page' => 10]),
        ];

        $processResults = [];
        $client->executeAll($commands, [
            'process' => function (ProcessEvent $e) use (&$processResults) {
                $processResults[] = $e->getResult();
            }
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
    public function testPostProductParallelRequests10AndDeleteProductParallelRequests10 ()
    {

        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);

        $commands = [
            $client->getCommand('PostProduct', [
                'ForeignId' => '',
                'Title' => '',
                'Description' => '',
                'ShortDescription' => '',
                'Price' => 1.23,
                'Ean' => 'abc123',
                'StockAmount' => 1,
            ]),
        ];

        $processResults = [];
        $client->executeAll($commands, [
            'process' => function (ProcessEvent $e) use (&$processResults) {
                $processResults[] = $e->getResult();
            }
        ]);
    }
}
