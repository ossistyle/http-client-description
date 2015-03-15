<?php

namespace Vws\Test\Integ;

use Vws\Exception\VwsException;
use GuzzleHttp\Event\BeforeEvent;

class BlackboxClientSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetCatalogEnsureResponseHasGivenId117697AsFirstEntry()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogs();
        // Herren catalog exists
        $this->assertSame(117697, $response->search('EntityList[0].Id'));
    }

    /**
     *
     */
    public function testGetCatalogsEnsureResponseHasGivenId117702AsChildCatalog()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogs();
        // Damen -> Snowboard -> Snowboardjacken exists
        $this->assertSame(117702, $response->search('EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id'));
    }

    /**
     *
     */
    public function testGetCatalogsEnsureResponseContainsEmptyMessages()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogs();
        // empty message collection
        $this->assertEmpty($response->search('Messages'));
    }

    /**
     *
     *
     */
    public function testGetCatalogByIdCorrectId117702EnsureResponseContainsGivenId()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 117702]);

        // Herren catalog exists
        $this->assertSame(117702, $response->search('EntityList[0].Id'));
    }

    /**
     *
     *
     */
    public function testGetCatalogByIdCorrectId117702EnsureResponseContainsEmptyMessages()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 117702]);
        // empty message collection
        $this->assertEmpty($response->search('Messages'));
    }

    /**
     *
     *
     */
    public function testGetCatalogByIdWrongId4711EnsureResponseContainsMessagesCode3000()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 4711]);

        // error message exists
        $this->assertSame('3000', $response->search('Messages[0].Code'));
    }

    /**
     *
     *
     */
    public function testGetCatalogByIdWrongId4711EnsureResponseContainsEmptyEntityList()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 4711]);

        // empty entitylist collection
        $this->assertEmpty($response->search('EntityList'));
    }

    /**
     * { "Code": "3103", "Severity": 2, "Message": "Name is empty." }
     */
    public function testPostCatalogNoNameEnsureResponseContainsMessagesError3103()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => '',
                'IsRootLevel' => true,
                'ForeignId' => 'root_1',
                'ChildCatalogs' => [
                    [
                        'Name' => 'Child Catalog 1.1',
                        'ForeignId' => 'child_1_1',
                    ],
                    [
                        'Name' => 'Child Cata1og 1.2',
                        'ForeignId' => 'child_1_2',
                        'ChildCatalogs' => [
                            [
                                'Name' => 'Child Catalog 1.2.1',
                                'ForeignId' => 'child_1_2_1',
                            ],
                            [
                                'Name' => 'Child Cata1og 1.2.2',
                                'ForeignId' => 'child_1_2_2',
                            ]
                        ]
                    ]
                ]
            ]
        );

        // error message exists
        $this->assertSame('3103', $response->search('Messages[0].Code'));
    }

    /**
     * { "Code": "3103", "Severity": 2, "Message": "Name is empty." }
     */
    public function testPostCatalogNoForeignidEnsureResponseContainsMessagesError3103()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => 'Root Catalog',
                'IsRootLevel' => true,
                'ForeignId' => '',
                'ChildCatalogs' => [
                    [
                        'Name' => 'Child Catalog 1.1',
                        'ForeignId' => 'child_1_1',
                    ],
                    [
                        'Name' => 'Child Cata1og 1.2',
                        'ForeignId' => 'child_1_2',
                        'ChildCatalogs' => [
                            [
                                'Name' => 'Child Catalog 1.2.1',
                                'ForeignId' => 'child_1_2_1',
                            ],
                            [
                                'Name' => 'Child Cata1og 1.2.2',
                                'ForeignId' => 'child_1_2_2',
                            ]
                        ]
                    ]
                ]
            ]
        );

        // error message exists
        $this->assertSame('3103', $response->search('Messages[0].Code'));
    }
}
