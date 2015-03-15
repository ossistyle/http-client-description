<?php

namespace Vws\Test;

use Vws\VwsClient;
use Vws\Credentials\Credentials;
use Vws\Blackbox\BlackboxClient;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

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
                    'endpointPrefix' => 'foo'
                ]
            ];
        };
    }

    /**
     * [testHasGetters description]
     */
    public function testHasGetters()
    {
        $config = [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'region'       => 'foo',
            'endpoint'     => 'http://sandboxapi.via.de:8001/api',
            'serializer'   => function () {},
            'api_provider' => $this->getApiProvider(),
            'service'      => 'foo',
            'error_parser' => function () {},
            'version'      => 'latest'
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
     * [testReturnsCommandForOperation description]
     */
    public function testReturnsCommandForOperation()
    {
        $client = $this->createClient([
            'operations' => [
                'foo' => [
                    'http' => ['method' => 'POST']
                ]
            ]
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
                'endpoint'   => 'http://foo.com'
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
     * [testChecksBothLowercaseAndUppercaseOperationNames description]
     */
    public function testChecksBothLowercaseAndUppercaseOperationNames()
    {
        $client = $this->createClient(['operations' => ['Foo' => [
            'http' => ['method' => 'POST']
        ]]]);

        $this->assertInstanceOf(
            'GuzzleHttp\Command\CommandInterface',
            $client->getCommand('foo')
        );
    }

    // public function testCanGetIterator()
    // {
    //     $client = $this->getTestClient('blackbox');
    //     $this->assertInstanceOf(
    //         'Generator',
    //         $client->getIterator('ListObjects', ['Bucket' => 'foobar'])
    //     );
    // }

    /**
     * @expectedException \UnexpectedValueException
     */
    // public function testGetIteratorFailsForMissingConfig()
    // {
    //     $client = $this->createClient();
    //     $client->getIterator('ListObjects');
    // }
    //
    // public function testCanGetPaginator()
    // {
    //     $client = $this->createClient(['pagination' => [
    //         'ListObjects' => [
    //             'input_token' => 'foo',
    //             'output_token' => 'foo',
    //         ]
    //     ]]);
    //
    //     $this->assertInstanceOf(
    //         'Aws\ResultPaginator',
    //         $client->getPaginator('ListObjects', ['Bucket' => 'foobar'])
    //     );
    // }
    //
    // /**
    //  * @expectedException \UnexpectedValueException
    //  */
    // public function testGetPaginatorFailsForMissingConfig()
    // {
    //     $client = $this->createClient();
    //     $client->getPaginator('ListObjects');
    // }

    /**
     * [testCreatesClientsFromFactoryMethod description]
     */
    public function testCreatesClientsFromFactoryMethod()
    {
        $client = new BlackboxClient([
            'region'  => 'sandbox',
            'version' => 'latest'
        ]);
        $this->assertInstanceOf('Vws\Blackbox\BlackboxClient', $client);
        $this->assertEquals('sandbox', $client->getRegion());
    }

    /**
     * [testCanGetEndpoint description]
     */
    public function testCanGetEndpoint()
    {
        $client = $this->createClient();
        $this->assertEquals(
            'http://sandboxapi.via.de:8001/api',
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
            'endpoint'     => 'http://sandboxapi.via.de:8001/api',
            'region'       => 'foo',
            'service'      => 'foo',
            'api_provider' => $apiProvider,
            'serializer'   => function () {},
            'error_parser' => function () {},
            'version'      => 'latest'
        ]);
    }

}
