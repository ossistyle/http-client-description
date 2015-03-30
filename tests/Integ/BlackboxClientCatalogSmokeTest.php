<?php

namespace Vws\Test\Integ;

use Vws\Blackbox\Exception\BlackboxException;
use Vws\Result;

/**
 *
 */
class BlackboxClientCatalogSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils, CatalogDataProvider;

    /**
     * @dataProvider catalogData
     */
    public function testPostCatalogValidation(
        $catalog,
        $expectedResponse
    ) {
        $client = $this->createClient();

        try {
            $response = $client->postCatalog($catalog);

            $this->assertCount(
                $expectedResponse['EntityListCount'],
                $response->search('EntityList'),
                $expectedResponse['ReturnMessage'] . ' EntityListCount: '  . $expectedResponse['EntityListCount']
            );

            $this->assertSame(
                $expectedResponse['StatusCode'],
                201,
                $expectedResponse['ReturnMessage'] . ' StatusCode: ' . $expectedResponse['StatusCode']
            );

            if (isset($expectedResponse['Messages'])) {
                foreach ($expectedResponse['Messages'] as $counter => $message) {
                    foreach ($message as $name => $value) {
                        if ($name === 'Message' || $name === 'Description') {
                            $this->assertRegExp(
                                '/' . $value . '/',
                                $response->search('Messages['.$counter.'].' . $name),
                                '###Docs    ' . $expectedResponse['ReturnMessage'] . ' Messages['.$counter.']'.$name.' = ' . $value
                            );
                        } else {
                            $this->assertEquals(
                                $value,
                                $response->search('Messages['.$counter.'].' . $name),
                                $expectedResponse['ReturnMessage'] . ' Messages['.$counter.']'.$name.' = ' . $value
                            );
                        }
                    }
                }
            }

            $toDeleteCatalogId = [];
            $toDeleteCatalogId[] = $response->search('EntityList[0].Id');
            $toDeleteCatalogId[] = $response->search('EntityList[0].ChildCatalogs[0].Id');

            return $toDeleteCatalogId;

        } catch (BlackboxException $e) {
            $this->assertEquals(
                $expectedResponse['StatusCode'],
                $e->getStatusCode(),
                $expectedResponse['ReturnMessage'] . 'StatusCode ' . $expectedResponse['StatusCode']
            );

            $responseBody = json_decode(
                $e->getResponse()->getBody()->__toString(),
                true
            );
            $result = new Result($responseBody);

            $this->assertCount(
                $expectedResponse['EntityListCount'],
                $result->search('EntityList')
            );

            if (isset($expectedResponse['Messages'])) {
                foreach ($expectedResponse['Messages'] as $counter => $message) {
                    foreach ($message as $name => $value) {
                        if ($name === 'Message' || $name === 'Description') {
                            $this->assertRegExp(
                                '/' . $value . '/',
                                $result->search('Messages['.$counter.'].' . $name),
                                '###Docs    ' . $expectedResponse['ReturnMessage'] . ' Messages['.$counter.']'.$name.' = ' . $value
                            );
                        } else {
                            $this->assertEquals(
                                $value,
                                $result->search('Messages['.$counter.'].' . $name),
                                $expectedResponse['ReturnMessage'] . ' Messages['.$counter.']'.$name.' = ' . $value
                            );
                        }
                    }
                }
            }
        }
    }

    /**
     * @depends testPostCatalogValidation
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
