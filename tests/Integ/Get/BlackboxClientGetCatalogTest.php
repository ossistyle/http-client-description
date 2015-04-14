<?php

namespace Vws\Test\Integ\Get;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientGetCatalogTest extends BlackboxClientAbstractTestCase
{
    /**
     *
     */
    public function testGetCatalogs()
    {
        $client = $this->createClient();
        $response = $client->getCatalogs();

        $this->assertSame(
            117697,
            $response->search('EntityList[0].Id'),
            'EntityList[0].Id is not equal to 117697'
        );
        $this->assertSame(
            117702,
            $response->search('EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id'),
            'EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id is not equal to 117702'
        );

        $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     */
    public function testGetCatalogById117702()
    {
        $client = $this->createClient();
        $response = $client->getCatalogById(['Id' => 117702]);

        $this->assertSame(
            117702,
            $response->search('EntityList[0].Id'),
            'EntityList[0].Id is not equal to 117702'
        );
        $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     */
    public function testGetCatalogById4711()
    {
        $client = $this->createClient();
        $response = $client->getCatalogById(['Id' => 4711]);

        // error message exists
        $this->assertSame(
            '3000',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 3000'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Error (2)'
        );
        $this->assertSame(
            'The specified CatalogId 4711 was not found.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . 'The specified CatalogId 4711 was not found.'
        );
        $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
    }
}
