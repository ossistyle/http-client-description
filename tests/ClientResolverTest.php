<?php
namespace Vws\Test;

use Vws\ClientResolver;
use Vws\WebApi\Credentials\Credentials;
use Vws\Exception\VwsException;
use Vws\WebApi\WebApiClient;
use GuzzleHttp\Client;
use Vws\Credentials\CredentialProvider;
use GuzzleHttp\Event\Emitter;

/**
 * @covers Vws\ClientResolver
 */
class ClientResolverTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing required client configuration options
     */
    public function testEnsuresRequiredArgumentsAreProvided()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $r->resolve([], new Emitter());
    }

    public function testAddsValidationSubscriber()
    {
        $c = new WebApiClient([
            'region'  => 'x',
            'version' => 'latest',
            'credentials' => false
        ]);

        try {
            // PostCatalog requires actual input parameters.
            $c->GetProduct([]);
            $this->fail('Did not validate');
        } catch (VwsException $e) {
        }
    }

    /**
     * @expectedException \Vws\Exception\VwsException
     * @expectedExceptionMessage Throwing!
     */
    public function testCanDisableValidation()
    {
        $c = new WebApiClient([
            'region'   => 'x',
            'version'  => 'latest',
            'validate' => false,
            'credentials' => false
        ]);
        $command = $c->getCommand('GetProducts');
        $command->getEmitter()->on('prepared', function () {
            throw new \Exception('Throwing!');
        });
        $c->execute($command);
    }

    public function testAppliesApiProvider()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $provider = function () {
            return ['metadata' => ['protocol' => 'rest-json']];
        };
        $conf = $r->resolve([
            'service'      => 'webapi',
            'region'       => 'x',
            'api_provider' => $provider,
            'version'      => 'latest',
            'credentials' => false
        ], new Emitter());
        $this->assertArrayHasKey('api', $conf);
        $this->assertArrayHasKey('error_parser', $conf);
        $this->assertArrayHasKey('serializer', $conf);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for "foo". Expected string, but got int(-1)
     */
    public function testValidatesInput()
    {
        $r = new ClientResolver([
            'foo' => [
                'type'  => 'value',
                'valid' => ['string'],
            ],
        ]);
        $r->resolve(['foo' => -1], new Emitter());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid configuration value provided for "foo". Expected callable, but got string(1) "c"
     */
    public function testValidatesCallables()
    {
        $r = new ClientResolver([
            'foo' => [
                'type'   => 'value',
                'valid'  => ['callable'],
            ],
        ]);
        $r->resolve(['foo' => 'c'], new Emitter());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Credentials must be an
     */
    public function testValidatesCredentials()
    {
        $r = new ClientResolver([
            'credentials' => ClientResolver::getDefaultArguments()['credentials'],
        ]);
        $r->resolve(['credentials' => []], new Emitter());
    }

    public function testLoadsFromDefaultChainIfNeeded()
    {
        $secret = getenv(CredentialProvider::ENV_SECRET);
        $token = getenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN);
        $vendor = getenv(CredentialProvider::ENV_VENDOR);
        $version = getenv(CredentialProvider::ENV_VERSION);

        putenv(CredentialProvider::ENV_SECRET.'=secret_foo');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'=token_foo');
        putenv(CredentialProvider::ENV_VENDOR.'=vendor_foo');
        putenv(CredentialProvider::ENV_VERSION.'=version_foo');
        putenv(CredentialProvider::ENV_USERNAME.'=');
        putenv(CredentialProvider::ENV_PASSWORD.'=');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'webapi',
            'region' => 'x',
            'version' => 'latest',
        ], new Emitter());
        $c = $conf['credentials'];
        $this->assertInstanceOf('Vws\Credentials\CredentialsInterface', $c);
        $this->assertEquals('secret_foo', $c->getSecret());
        $this->assertEquals('token_foo', $c->getToken());
        $this->assertEquals('vendor_foo', $c->getVendor());
        $this->assertEquals('version_foo', $c->getVersion());
        putenv(CredentialProvider::ENV_SECRET."=$secret");
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN."=$token");
        putenv(CredentialProvider::ENV_VENDOR."=$vendor");
        putenv(CredentialProvider::ENV_VERSION."=$version");
    }

    public function testCreatesFromArray()
    {
        $exp = time() + 500;
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'webapi',
            'region'      => 'x',
            'version'     => 'latest',
            'credentials' => [
                'secret'     => 'secret_foo',
                'subscription_token'   => 'token_foo',
                'vendor' => 'vendor_foo',
                'version' => 'version_foo'
            ],
        ], new Emitter());
        $creds = $conf['credentials'];
        $this->assertEquals('secret_foo', $creds->getSecret());
        $this->assertEquals('token_foo', $creds->getToken());
        $this->assertEquals('vendor_foo', $creds->getVendor());
        $this->assertEquals('version_foo', $creds->getVersion());
    }

    public function testCanCreateNullCredentials()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'webapi',
            'region' => 'x',
            'credentials' => false,
            'version' => 'latest',
        ], new Emitter());
        $this->assertEquals(
            false,
            $conf['credentials']
        );
    }

    public function testCanCreateCredentialsFromProvider()
    {
        $c = new \Vws\WebApi\Credentials\Credentials('secret', 'token', 'vendor', 'version');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'webapi',
            'region'      => 'x',
            'credentials' => function () use ($c) { return $c; },
            'version'     => 'latest',
        ], new Emitter());
        $this->assertSame($c, $conf['credentials']);
    }

    public function testCanUseCredentialsObject()
    {
        $c = new \Vws\WebApi\Credentials\Credentials('secret', 'token', 'vendor', 'version');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'webapi',
            'region'      => 'x',
            'credentials' => $c,
            'version'     => 'latest',
        ], new Emitter());
        $this->assertSame($c, $conf['credentials']);
    }

    public function testAddsDebugListener()
    {
        $em = new Emitter();
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $r->resolve([
            'service'  => 'webapi',
            'region'   => 'x',
            'debug'    => true,
            'version'  => 'latest',
            'credentials' => false
        ], $em);
        $this->assertTrue(SdkTest::hasListener(
            $em,
            'GuzzleHttp\Command\Subscriber\Debug',
            'prepared'
        ));
    }

    public function canSetDebugToFalse()
    {
        $em = new Emitter();
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $r->resolve([
            'service'  => 'webapi',
            'region'   => 'x',
            'debug'    => false,
            'version'  => 'latest',
            'credentials' => false
        ], $em);
        $this->assertFalse(SdkTest::hasListener(
            $em,
            'GuzzleHttp\Command\Subscriber\Debug',
            'prepared'
        ));
    }

    /**
     * @expectedException \GuzzleHttp\Exception\RequestException
     * @expectedExceptionMessage foo
     */
    public function testCanProvideCallableClient()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'webapi',
            'region'  => 'x',
            'version' => 'latest',
            'credentials' => false,
            'client' => function (array $args) {
                return new Client([
                    'handler' => function () {
                        throw new \UnexpectedValueException('foo');
                    },
                ]);
            },
        ], new Emitter());

        $conf['client']->get('http://localhost:123');
    }

    public function testCanAddHttpClientDefaultOptions()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'webapi',
            'region'  => 'x',
            'version' => 'latest',
            'http'    => ['foo' => 'bar'],
            'credentials' => false
        ], new Emitter());
        $this->assertEquals('bar', $conf['client']->getDefaultOption('foo'));
    }

    public function testSkipsNonRequiredKeys()
    {
        $r = new ClientResolver([
            'foo' => [
                'valid' => ['int'],
                'type'  => 'value',
            ],
        ]);
        $r->resolve([], new Emitter());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage A "version" configuration value is required
     */
    public function testHasSpecificMessageForMissingVersion()
    {
        $args = ClientResolver::getDefaultArguments()['version'];
        $r = new ClientResolver(['version' => $args]);
        $r->resolve(['service' => 'foo'], new Emitter());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage A "region" configuration value is required for the "foo" service
     */
    public function testHasSpecificMessageForMissingRegion()
    {
        $args = ClientResolver::getDefaultArguments()['region'];
        $r = new ClientResolver(['region' => $args]);
        $r->resolve(['service' => 'foo'], new Emitter());
    }
}
