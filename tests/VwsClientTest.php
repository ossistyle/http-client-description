<?php

namespace Vws\Test;

use Vws\VwsClient;
use Vws\Credentials\Credentials;
use Vws\WebApi\WebApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Message\Request;

/**
 * @covers Vws\VwsClient
 */
class VwsClientTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    private function getApiProvider()
    {
        return function () {
            return [
                'metadata' => [
                    'protocol'       => 'rest-json',
                    'endpointPrefix' => 'foo',
                ],
            ];
        };
    }

    /**
     * [testHasGetters description].
     */
    public function testHasGetters()
    {
        $config = [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'region'       => 'foo',
            'endpoint'     => 'http://dus-bb-api802.dus.via.de/api/',
            'serializer'   => function () {},
            'api_provider' => $this->getApiProvider(),
            'service'      => 'foo',
            'error_parser' => function () {},
            'version'      => 'latest',
        ];

        $client = new VwsClient($config);
        $this->assertSame($config['client'], $client->getHttpClient());
        $this->assertSame($config['credentials'], $client->getCredentials());
        $this->assertSame($config['region'], $client->getRegion());
        $this->assertEquals('foo', $client->getApi()->getEndpointPrefix());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Operation not found: Foo
     */
    public function testEnsuresOperationIsFoundWhenCreatingCommands()
    {
        $this->createClient()->getCommand('foo');
    }

    /**
     * [testReturnsCommandForOperation description].
     */
    public function testReturnsCommandForOperation()
    {
        $client = $this->createClient([
            'operations' => [
                'foo' => [
                    'http' => ['method' => 'POST'],
                ],
            ],
        ]);

        $this->assertInstanceOf(
            'GuzzleHttp\Command\CommandInterface',
            $client->getCommand('foo')
        );
    }

    /**
     * @expectedException \Vws\Exception\VwsException
     * @expectedExceptionMessage Uncaught exception while executing Vws\VwsClient::foo - Baz Bar!
     */
    public function testWrapsUncaughtExceptions()
    {
        $client = $this->createClient(
            ['operations' => ['foo' => ['http' => ['method' => 'POST']]]]
        );
        $command = $client->getCommand('foo');
        $command->getEmitter()->on('init', function () {
            throw new \RuntimeException('Baz Bar!');
        });
        $client->execute($command);
    }

    /**
     * @expectedException \Vws\Exception\VwsException
     * @expectedExceptionMessage Error executing Vws\VwsClient::foo() on "http://foo.com/"; Baz Bar!
     */
    public function testHandlesNetworkingErrorsGracefully()
    {
        $r = new Request('GET', 'http://foo.com');
        $client = $this->createClient(
            ['operations' => ['foo' => ['http' => ['method' => 'POST']]]],
            [
                'serializer' => function () use ($r) {
                    return $r;
                },
                'endpoint'   => 'http://foo.com',
            ]
        );
        $command = $client->getCommand('foo');
        $command->getEmitter()->on('prepared', function (PreparedEvent $e) {
            $e->getRequest()->getEmitter()->on('before', function () {
                throw new \RuntimeException('Baz Bar!');
            });
        });
        $client->execute($command);
    }

    /**
     * [testChecksBothLowercaseAndUppercaseOperationNames description].
     */
    public function testChecksBothLowercaseAndUppercaseOperationNames()
    {
        $client = $this->createClient(['operations' => ['Foo' => [
            'http' => ['method' => 'POST'],
        ]]]);

        $this->assertInstanceOf(
            'GuzzleHttp\Command\CommandInterface',
            $client->getCommand('foo')
        );
    }

    public function testCanGetIterator()
    {
        $client = $this->getTestClient('webapi');
        $this->assertInstanceOf(
            'Generator',
            $client->getIterator('GetProducts', ['PageNumber' => 2])
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testGetIteratorFailsForMissingConfig()
    {
        $client = $this->createClient();
        $client->getIterator('GetCatalogs');
    }

    public function testCanGetPaginator()
    {
        $client = $this->createClient(['pagination' => [
            'GetProducts' => [
                'EntriesPerPage' => 50,
                'PageNumber' => 3,
            ],
        ]]);

        $this->assertInstanceOf(
            'Vws\ResultPaginator',
            $client->getPaginator('GetProducts', ['PageNumber' => 2])
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testGetPaginatorFailsForMissingConfig()
    {
        $client = $this->createClient();
        $client->getPaginator('GetProducts');
    }

    /**
     * [testCreatesClientsFromFactoryMethod description].
     */
    public function testCreatesClientsFromFactoryMethod()
    {
        $client = new WebApiClient([
            'region'  => 'sandbox',
            'version' => 'latest',
        ]);
        $this->assertInstanceOf('Vws\WebApi\WebApiClient', $client);
        $this->assertEquals('sandbox', $client->getRegion());
    }

    /**
     * [testCanGetEndpoint description].
     */
    public function testCanGetEndpoint()
    {
        $client = $this->createClient();
        $this->assertEquals(
            'http://dus-bb-api802.dus.via.de/api/',
            $client->getEndpoint()
        );
    }

    private function createClient(array $service = [], array $config = [])
    {
        $apiProvider = function ($type) use ($service, $config) {
            if ($type == 'paginator') {
                return isset($service['pagination'])
                    ? ['pagination' => $service['pagination']]
                    : ['pagination' => []];
            } elseif ($type == 'waiter') {
                return isset($service['waiters'])
                    ? ['waiters' => $service['waiters']]
                    : ['waiters' => []];
            } else {
                if (!isset($service['metadata'])) {
                    $service['metadata'] = [];
                }
                $service['metadata']['protocol'] = 'rest-json';

                return $service;
            }
        };

        return new VwsClient($config + [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'endpoint'     => 'http://dus-bb-api802.dus.via.de/api/',
            'region'       => 'foo',
            'service'      => 'foo',
            'api_provider' => $apiProvider,
            'serializer'   => function () {},
            'error_parser' => function () {},
            'version'      => 'latest',
        ]);
    }
}
