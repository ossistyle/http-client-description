<?php

namespace Vws\Test;

use GuzzleHttp\Client;
use Vws\Api\ServiceModel;
use Vws\Blackbox\BlackboxClient;
use Vws\Credentials\Credentials;
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

    public function testHasGetters()
    {
        $config = [
            'client'       => new Client(),
            'credentials'  => new Credentials('foo', 'bar', 'foo_bar'),
            'region'       => 'foo',
            'endpoint'     => 'https://local.via.de',
            'serializer'   => function () {},
            'api'          => new ServiceModel(function () {}, 'foo', 'bar'),
            'version'      => 'latest'
        ];

        $client = new VwsClient($config);
        $this->assertSame($config['client'], $client->getHttpClient());
        $this->assertSame($config['credentials'], $client->getCredentials());
        $this->assertSame($config['region'], $client->getRegion());
        $this->assertSame($config['api'], $client->getApi());

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
    public function testEnsureMissingRequiredArgumentsThrowException ()
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
            'version'      => 'latest'
        ]);
    }
}
