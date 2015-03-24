<?php

namespace Vws\Test;

use Vws\Result;

/**
 * @covers Vws\ResultPaginator
 */
class ResultPaginatorTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    /**
     * @dataProvider getPaginatorIterationData
     */
    public function testStandardIterationWorkflow(
        array $config,
        array $results,
        $expectedRequestCount,
        array $expectedTableNames
    ) {
        $requestCount = 0;

        // Create the client and paginator
        $client = $this->getTestClient('blackbox');
        $this->addMockResults($client, $results);
        $paginator = $client->getPaginator('GetProducts', ['limit' => 10, 'page' => 1], $config + [
            'process' => function () use (&$requestCount) {
                $requestCount++;
            },
        ]);

        // Iterate over the paginator and keep track of the keys and values
        $tableNames = [];
        $lastKey = $result = null;
        foreach ($paginator as $key => $result) {
            $tableNames = array_merge($tableNames, $result['EntityList']);
            $lastKey = $key;
        }

        // Make sure the paginator yields the expected results
        $this->assertInstanceOf('Vws\\Result', $result);
        $this->assertEquals($expectedRequestCount, $requestCount);
        $this->assertEquals($expectedRequestCount - 1, $lastKey);
        $this->assertEquals($expectedTableNames, $tableNames);
    }

    /**
     * @return array Test data
     */
    public function getPaginatorIterationData()
    {
        return [
            // Single field token case
            [
                // Config
                ['limit' => 'Pagination.EntriesPerPage', 'page' => 'Pagination.PageNumber'],
                // Results
                [
                    new Result([
                        'Pagination' => [
                            'EntriesPerPage' => 10,
                            'PageNumber' => 1,
                            'HasNextPage' => true,
                        ],
                        'EntityList' => [
                            [
                                'Title' => 'test1',
                            ],
                            [
                                'Title' => 'test2',
                            ],
                        ],
                    ]),
                    new Result([
                        'Pagination' => [
                            'EntriesPerPage' => 10,
                            'PageNumber' => 1,
                            'HasNextPage' => false,
                        ],
                        'EntityList' => [

                        ],
                    ]),
                    new Result([
                        'Pagination' => [
                            'EntriesPerPage' => 10,
                            'PageNumber' => 1,
                            'HasNextPage' => false,
                        ],
                        'EntityList' => [
                            [
                                'Title' => 'test3',
                            ],
                        ],
                    ]),
                ],
                // Request count
                2,
                // Table names
                [
                    [
                        'Title' => 'test1',
                    ],
                    [
                        'Title' => 'test2',
                    ],

                ],
            ],
        ];
    }

    public function testCanSearchOverResultsUsingFlatMap()
    {
        $requestCount = 0;
        $client = $this->getTestClient('blackbox');
        $this->addMockResults($client, [
            new Result([
                'Pagination' => [
                    'EntriesPerPage' => 10,
                    'PageNumber' => 1,
                    'HasNextPage' => true,
                ],
                'EntityList' => [
                    [
                        'Title' => 'test1',
                    ],
                    [
                        'Title' => 'test2',
                    ],
                ],
            ]),
            new Result([
                'Pagination' => [
                    'EntriesPerPage' => 10,
                    'PageNumber' => 1,
                    'HasNextPage' => true,
                ],
                'EntityList' => [

                ],
            ]),
            new Result([
                'EntityList' => [
                    [
                        'Title' => 'test3',
                    ],
                ],
            ]),
            #new Result(['TableNames' => ['d4']]),
        ]);

        #['limit' => 'Pagination.EntriesPerPage', 'page' => 'Pagination.PageNumber'],

        $paginator = $client->getPaginator('GetProducts', ['limit' => 10, 'page' => 1], [
            'limit'  => 'Pagination.EntriesPerPage',
            'page' => 'Pagination.PageNumber',
            'process'      => function () use (&$requestCount) {
                $requestCount++;
            },
        ]);

        $tableNames = [];
        foreach ($paginator->search('EntityList[]', 3) as $table) {
            $tableNames[] = $table;
        }

        $this->assertEquals(3, $requestCount);
        $this->assertEquals([
            [
                'Title' => 'test1',
            ],
            [
                'Title' => 'test2',
            ],
            [
                'Title' => 'test3',
            ],
        ], $tableNames);
    }
}
