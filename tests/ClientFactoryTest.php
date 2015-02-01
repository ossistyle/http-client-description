<?php

namespace Vws\Test;

use Vws\ClientFactory;
use Vws\Credentials\Credentials;
use Vws\Credentials\NullCredentials;

/**
 * @covers Vws\ClientFactory
 */
class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatesNewClientInstances()
    {
        $f = new ClientFactory();
        $args = [
            'service' => 'blackbox',
            'region'  => 'x',
            'version' => 'latest'
        ];
        $c = $f->create($args);
        $this->assertInstanceOf('Vws\VwsClientInterface', $c);
        $this->assertNotSame($c, $f->create($args));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEnsuresRequiredArgumentsAreProvided()
    {
        $f = new ClientFactory();
        $f->create([]);
    }

    public function testCanSpecifyValidClientClass()
    {
        $f = new ClientFactory();
        $this->assertInstanceOf('Vws\Blackbox\BlackboxClient', $f->create([
            'service'    => 'blackbox',
            'region'     => 'x',
            'class_name' => 'Vws\Blackbox\BlackboxClient',
            'version'    => 'latest'
        ]));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for client.
     */
    public function testValidatesClient()
    {
        $f = new ClientFactory();
        $f->create([
            'service' => 'blackbox',
            'region'  => 'x',
            'client'  => [0, 1, 2],
            'version' => 'latest'
        ]);
    }

    public function testCanSpecifyValidExceptionClass()
    {
        $f = new ClientFactory();
        $f->create([
            'service'         => 'blackbox',
            'region'          => 'x',
            'exception_class' => 'Aws\Exception\AwsException',
            'version' => 'latest'
        ]);
    }


    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for api_provider.
     */
    public function testValidatesApiProvider()
    {
        $f = new ClientFactory();
        $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'api_provider' => [0, 1, 2],
            'version' => 'latest'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for endpoint_provider
     */
    public function testValidatesEndpointProvider()
    {
        $f = new ClientFactory();
        $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'endpoint_provider' => [0, 1, 2],
            'version' => 'latest'
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for credentials
     */
    public function testValidatesCredentials()
    {
        $f = new ClientFactory();
        $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'credentials' => new \stdClass(),
            'version' => 'latest'
        ]);
    }

    public function testCanCreateNullCredentials()
    {
        $f = new ClientFactory();
        $c = $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'credentials' => false,
            'version' => 'latest'
        ]);
        $this->assertInstanceOf(
            'Vws\Credentials\NullCredentials',
            $c->getCredentials()
        );
    }

    public function testCanCreateCredentialsFromProvider()
    {
        $f = new ClientFactory();
        $c = new Credentials('foo', 'bar', 'foo_bar');
        $client = $f->create([
            'service'     => 'blackbox',
            'region'      => 'x',
            'credentials' => function () use ($c) { return $c; },
            'version'     => 'latest'
        ]);
        $this->assertSame($c, $client->getCredentials());
    }

    public function testCanUseCredentialsObject()
    {
        $creds = new NullCredentials();
        $f = new ClientFactory();
        $c = $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'credentials' => $creds,
            'version' => 'latest'
        ]);
        $this->assertSame($creds, $c->getCredentials());
    }

    public function testCanUseCredentialsArray()
    {
        $credsArray = [
            'username' => 'foo',
            'password' => 'bar',
            'subscription_token' => 'foo_bar'
        ];
        $creds = new Credentials(
                $credsArray['username'],
                $credsArray['password'],
                $credsArray['subscription_token']
        );
        $f = new ClientFactory();
        $c = $f->create([
            'service' => 'blackbox',
            'region' => 'x',
            'credentials' => $credsArray,
            'version' => 'latest'
        ]);
        $this->assertEquals($creds, $c->getCredentials());
    }

    public function testCanAddClientDefaultOptions()
    {
        $f = new ClientFactory();
        $client = $f->create([
            'service'         => 'blackbox',
            'region'          => 'x',
            'version'         => 'latest',
            'client_defaults' => ['foo' => 'bar']
        ]);
        $this->assertEquals('bar', $client->getHttpClient()->getDefaultOption('foo'));
    }

    /**
     * @expectedException \Vws\Exception\VwsException
     * @expectedExceptionMessage Throwing!
     */
    public function testCanDisableValidation()
    {
        $f = new ClientFactory();
        $c = $f->create([
            'service'           => 'blackbox',
            'region'            => 'x',
            'version'           => 'latest',
            'validate_service'  => false
        ]);
        $command = $c->getCommand('PostCatalog');
        $command->getEmitter()->on('prepared', function () {
            throw new \Exception('Throwing!');
        });
        $c->execute($command);
    }
}
