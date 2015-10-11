<?php

namespace Vws\Test\Integ\WebApi\Delete;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientDeleteCatalogTest extends ClientAbstractTestCase
{
    /**
     *
     */
    public function testDeleteCatalogById()
    {
        $args = func_get_args();

        $client = $this->createClient();

        foreach ($args as $values) {
            foreach ($values as $value) {
                $client->deleteCatalogById(['Id' => $value]);
                $getResponse = $client->getCatalogById(['Id' => $value]);

                $this->assertSame(
                    '3000',
                    $getResponse->search('Messages[0].Code'),
                    'Messages[0].Code is not 3000'
                );
                $this->assertSame(
                    2,
                    $getResponse->search('Messages[0].Severity'),
                    'Messages[0].Severity is not Error (2)'
                );
                $this->assertEmpty($getResponse->search('EntityList'), 'EntityList is not empty');
            }
        }
    }
}
