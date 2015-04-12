<?php

namespace Vws\Test\Integ;

use Vws\Blackbox\Exception\BlackboxException;
use Vws\Result;

class BlackboxClientAbstractTestCase extends AbstractTestCase
{
    use IntegUtils,
        ProductDataProvider,
        ProductVariationDataProvider;

    public function postProductValidation(
        $product,
        $expectedResponse
    ) {

        try {
            $response = $this->client->postProduct($product);

            $this->assertSame(
                $expectedResponse['StatusCode'],
                201,
                self::getCustomErrorMessage(
                    $expectedResponse['FunctionName'],
                    'HeaderStatusCode',
                    $expectedResponse['StatusCode'],
                    201
                )
            );

            $this->assertCount(
                $expectedResponse['EntityListCount'],
                $response->search('EntityList'),
                self::getCustomErrorMessage(
                    $expectedResponse['FunctionName'],
                    'EntityList',
                    $expectedResponse['EntityListCount'],
                    count($response->search('EntityList'))
                )
            );

            if (isset($expectedResponse['Messages'])) {
                foreach ($expectedResponse['Messages'] as $counter => $message) {
                    foreach ($message as $name => $value) {
                        if ($name === 'Message' || $name === 'Description') {
                            $this->assertRegExp(
                                '/' . $value . '/',
                                $response->search('Messages['.$counter.'].' . $name),
                                self::getCustomErrorMessage(
                                    $expectedResponse['FunctionName'],
                                    'Message',
                                    $value,
                                    $response->search('Messages['.$counter.'].' . $name),
                                    'Messages['.$counter.'].' . $name
                                )
                            );
                        } else {
                            $this->assertEquals(
                                $value,
                                $response->search('Messages['.$counter.'].' . $name),
                                self::getCustomErrorMessage(
                                    $expectedResponse['FunctionName'],
                                    'Message',
                                    $value,
                                    $response->search('Messages['.$counter.'].' . $name),
                                    'Messages['.$counter.'].' . $name
                                )
                            );
                        }
                    }
                }
            }

        } catch (BlackboxException $e) {
            $this->assertEquals(
                $expectedResponse['StatusCode'],
                $e->getStatusCode(),
                self::getCustomErrorMessage(
                    $expectedResponse['FunctionName'],
                    'HeaderStatusCode',
                    $expectedResponse['StatusCode'],
                    $e->getStatusCode()
                )
            );

            $responseBody = json_decode(
                $e->getResponse()->getBody()->__toString(),
                true
            );
            $response = new Result($responseBody);

            $this->assertCount(
                $expectedResponse['EntityListCount'],
                $response->search('EntityList'),
                self::getCustomErrorMessage(
                    $expectedResponse['FunctionName'],
                    'EntityList',
                    $expectedResponse['EntityListCount'],
                    count($response->search('EntityList'))
                )
            );

            if (isset($expectedResponse['Messages'])) {
                foreach ($expectedResponse['Messages'] as $counter => $message) {
                    foreach ($message as $name => $value) {
                        if ($name === 'Message' || $name === 'Description') {
                            $this->assertRegExp(
                                '/' . $value . '/',
                                $response->search('Messages['.$counter.'].' . $name),
                                self::getCustomErrorMessage(
                                    $expectedResponse['FunctionName'],
                                    'Message',
                                    $value,
                                    $response->search('Messages['.$counter.'].' . $name),
                                    'Messages['.$counter.'].' . $name
                                )
                            );
                        } else {
                            $this->assertEquals(
                                $value,
                                $response->search('Messages['.$counter.'].' . $name),
                                self::getCustomErrorMessage(
                                    $expectedResponse['FunctionName'],
                                    'Message',
                                    $value,
                                    $response->search('Messages['.$counter.'].' . $name),
                                    'Messages['.$counter.'].' . $name
                                )
                            );
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            $this->fail('Failed with php Exception ' . $e->getMessage());
        }
    }
}
