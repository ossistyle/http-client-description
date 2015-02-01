<?php

namespace Vws\Test;

use GuzzleHttp\Client;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

use GuzzleHttp\Subscriber\Mock;

use Vws\Api\ServiceModel;

use Vws\Blackbox\BlackboxClient;

use Vws\Credentials\Credentials;

use Vws\Exception\VwsException;


use Vws\VwsClient;

/**
 * @covers Vws\VwsClient
 */
class VwsClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetEndpoint()
    {
        $client = $this->createClient();
        $this->assertEquals(
            'http://local.via.de',
            $client->getEndpoint()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Operation not found: Foo
     */
    public function testEnsuresOperationIsFoundWhenCreatingCommands()
    {
        $this->createClient()->getCommand('foo');
    }

    public function testCanSpecifyDefaultCommandOptions()
    {
        $client = $this->createClient(['operations' => ['foo' => [
            'http' => ['method' => 'POST']
        ]]], ['defaults' => ['baz' => 'bam']]);

        $c = $client->getCommand('foo');
        $this->assertEquals('bam', $c['baz']);
    }

    public function testReturnsCommandForOperation()
    {
        $client = $this->createClient(['operations' => ['foo' => [
            'http' => ['method' => 'POST']
        ]]]);

        $this->assertInstanceOf(
            'GuzzleHttp\Command\CommandInterface',
            $client->getCommand('foo')
        );
    }

    public function testMergesDefaultCommandParameters()
    {
        $client = $this->createClient(
            ['operations' => ['foo' => ['http' => ['method' => 'POST']]]],
            ['defaults' => ['test' => 'foo']]
        );
        $command = $client->getCommand('foo', ['bar' => 'foo_bar']);
        $this->assertEquals('foo', $command['test']);
        $this->assertEquals('foo_bar', $command['bar']);
    }

    public function testHasGetters()
    {
        $config = [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'region'       => 'foo',
            'endpoint'     => 'https://local.via.de',
            'serializer'   => function () {},
            'api'          => new ServiceModel(function () {}, 'foo', 'bar'),
            'version'      => 'latest',
            'error_parser' => function () {},
        ];

        $client = new VwsClient($config);
        $this->assertSame($config['client'], $client->getHttpClient());
        $this->assertSame($config['credentials'], $client->getCredentials());
        $this->assertSame($config['region'], $client->getRegion());
        $this->assertSame($config['api'], $client->getApi());
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

    public function testCreatesClientsFromFactoryMethod()
    {
        $client = BlackboxClient::factory([
            'region'  => 'local',
            'version' => 'latest'
        ]);
        $this->assertInstanceOf('Vws\Blackbox\BlackboxClient', $client);
        $this->assertEquals('local', $client->getRegion());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage is a required option
     */
    public function testEnsureMissingRequiredArgumentsThrowException()
    {
        new VwsClient([]);
    }

    private function createClient(array $service = [], array $config = [])
    {
        $apiProvider = function ($type) use ($service, $config) {
            return $service;
        };

        $api = new ServiceModel($apiProvider, 'service', 'region');

        return new VwsClient($config + [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'endpoint'     => 'http://local.via.de',
            'region'       => 'foo',
            'api'          => $api,
            'serializer'   => function () {},
            'version'      => 'latest',
            'error_parser' => function () {},
        ]);
    }

    public function errorProvider()
    {
        return [
            [null, 'Vws\Exception\VwsException'],
            ['Vws\Blackbox\Exception\BlackboxException', 'Vws\Blackbox\Exception\BlackboxException']
        ];
    }

    /**
     * @dataProvider errorProvider
     */
    public function testThrowsSpecificErrors($value, $type)
    {
        $apiProvider = function () {
            return ['operations' => ['foo' => [
                'http' => ['method' => 'POST']
            ]]];
        };
        $service = new ServiceModel($apiProvider, 'foo', 'bar');

        $c = new Client();
        $client = new VwsClient([
            'client'          => $c,
            'credentials'     => new Credentials('foo', 'bar', 'foo_bar'),
            'endpoint'        => 'http://local.foo.via.de',
            'region'          => 'foo',
            'exception_class' => $value,
            'api'             => $service,
            'version'         => 'latest',
            'serializer'   => function () use ($c) {
                return $c->createRequest('GET', 'http://httpbin.org');
            },
            'error_parser'    => function () {
                return [
                    'code' => 'foo',
                    'type' => 'bar',
                    'request_id' => '123',
                    'messages' => []
                ];
            }
        ]);

        $client->getHttpClient()->getEmitter()->attach(new Mock([
            new Response(404)
        ]));

        try {
            $client->foo();
            $this->fail('Did not throw an exception');
        } catch (VwsException $e) {
            $this->assertInstanceOf($type, $e);
            $this->assertEquals([
                'vws_error' => [
                    'code' => 'foo',
                    'type' => 'bar',
                    'request_id' => '123',
                    'messages' => []
                ]
            ], $e->getTransaction()->context->toArray());
            $this->assertEquals('foo', $e->getVwsErrorCode());
            $this->assertEquals('bar', $e->getVwsErrorType());
            $this->assertEquals('123', $e->getVwsRequestId());
        }
    }

    /**
     * @expectedException \Vws\Exception\VwsException
     * @expectedExceptionMessage Error executing Vws\VwsClient::foo() on "http://foo.com"; Baz Bar!
     */
    public function testHandlesNetworkingErrorsGracefully()
    {
        $r = new Request('GET', 'http://foo.com');
        $client = $this->createClient(
            ['operations' => ['foo' => ['http' => ['method' => 'POST']]]],
            ['serializer' => function () use ($r) { return $r; }]
        );
        $command = $client->getCommand('foo');
        $command->getEmitter()->on('prepared', function (PreparedEvent $e) {
            $e->getRequest()->getEmitter()->on('before', function () {
                throw new \RuntimeException('Baz Bar!');
            });
        });
        $client->execute($command);
    }
}
