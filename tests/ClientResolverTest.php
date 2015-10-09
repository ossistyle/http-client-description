<?php
namespace Vws\Test;

use Vws\ClientResolver;
use Vws\Credentials\Credentials;
use Vws\Exception\VwsException;
use Vws\Blackbox\BlackboxClient;
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
        $c = new BlackboxClient([
            'region'  => 'x',
            'version' => 'latest',
        ]);

        try {
            // CreateTable requires actual input parameters.
            $c->PostCatalog([]);
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
        $c = new BlackboxClient([
            'region'   => 'x',
            'version'  => 'latest',
            'validate' => false,
        ]);
        $command = $c->getCommand('PostCatalog');
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
            'service'      => 'blackbox',
            'region'       => 'x',
            'api_provider' => $provider,
            'version'      => 'latest',
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
        $username = getenv(CredentialProvider::ENV_USERNAME);
        $password = getenv(CredentialProvider::ENV_PASSWORD);
        $token = getenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN);
        putenv(CredentialProvider::ENV_USERNAME.'=foo');
        putenv(CredentialProvider::ENV_PASSWORD.'=bar');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'=foo_bar');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'blackbox',
            'region' => 'x',
            'version' => 'latest',
        ], new Emitter());
        $c = $conf['credentials'];
        $this->assertInstanceOf('Vws\Credentials\CredentialsInterface', $c);
        $this->assertEquals('foo', $c->getUsername());
        $this->assertEquals('bar', $c->getPassword());
        $this->assertEquals('foo_bar', $c->getSubscriptionToken());
        putenv(CredentialProvider::ENV_USERNAME."=$username");
        putenv(CredentialProvider::ENV_PASSWORD."=$password");
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN."=$token");
    }

    public function testCreatesFromArray()
    {
        $exp = time() + 500;
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'blackbox',
            'region'      => 'x',
            'version'     => 'latest',
            'credentials' => [
                'username'     => 'foo',
                'password'  => 'baz',
                'subscription_token'   => 'tok',
            ],
        ], new Emitter());
        $creds = $conf['credentials'];
        $this->assertEquals('foo', $creds->getUsername());
        $this->assertEquals('baz', $creds->getPassword());
        $this->assertEquals('tok', $creds->getSubscriptionToken());
    }

    public function testCanCreateNullCredentials()
    {
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service' => 'blackbox',
            'region' => 'x',
            'credentials' => false,
            'version' => 'latest',
        ], new Emitter());
        $this->assertInstanceOf(
            'Vws\Credentials\NullCredentials',
            $conf['credentials']
        );
    }

    public function testCanCreateCredentialsFromProvider()
    {
        $c = new Credentials('foo', 'bar', 'foo_bar');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'blackbox',
            'region'      => 'x',
            'credentials' => function () use ($c) { return $c; },
            'version'     => 'latest',
        ], new Emitter());
        $this->assertSame($c, $conf['credentials']);
    }

//     public function testCanCreateCredentialsFromProfile()
//     {
//         $dir = sys_get_temp_dir() . '/.vws';
//         if (!is_dir($dir)) {
//             mkdir($dir, 0777, true);
//         }
//         $ini = <<<EOT
// [foo]
// vws_username = foo
// vws_password = baz
// vws_subscription_token = tok
// EOT;
//         file_put_contents($dir . '/credentials', $ini);
//         $r = new ClientResolver(ClientResolver::getDefaultArguments());
//         $conf = $r->resolve([
//             'service'     => 'sqs',
//             'region'      => 'x',
//             'profile'     => 'foo',
//             'version'     => 'latest'
//         ], new Emitter());
//         $creds = $conf['credentials'];
//         $this->assertEquals('foo', $creds->getAccessKeyId());
//         $this->assertEquals('baz', $creds->getSecretKey());
//         $this->assertEquals('tok', $creds->getSecurityToken());
//     }

    public function testCanUseCredentialsObject()
    {
        $c = new Credentials('foo', 'bar', 'foo_bar');
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $conf = $r->resolve([
            'service'     => 'blackbox',
            'region'      => 'x',
            'credentials' => $c,
            'version'     => 'latest',
        ], new Emitter());
        $this->assertSame($c, $conf['credentials']);
    }

    // public function testAddsLogger()
    // {
    //     $r = new ClientResolver(ClientResolver::getDefaultArguments());
    //     $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')
    //         ->getMockForAbstractClass();
    //     $conf = $r->resolve([
    //         'service'      => 'blackbox',
    //         'region'       => 'x',
    //         'retries'      => 2,
    //         'retry_logger' => $logger,
    //         'endpoint'     => 'http://sandboxapi.via.de:8001',
    //         'version'      => 'latest'
    //     ], new Emitter());
    //     $this->assertTrue(SdkTest::hasListener(
    //         $conf['client']->getEmitter(),
    //         'GuzzleHttp\Subscriber\Retry\RetrySubscriber',
    //         'error'
    //     ));
    // }
    //
    // public function testAddsLoggerWithDebugSettings()
    // {
    //     $r = new ClientResolver(ClientResolver::getDefaultArguments());
    //     $conf = $r->resolve([
    //         'service'      => 'blackbox',
    //         'region'       => 'x',
    //         'retry_logger' => 'debug',
    //         'endpoint'     => 'http://sandboxapi.via.de:8001',
    //         'version'      => 'latest'
    //     ], new Emitter());
    //     $this->assertTrue(SdkTest::hasListener(
    //         $conf['client']->getEmitter(),
    //         'GuzzleHttp\Subscriber\Retry\RetrySubscriber',
    //         'error'
    //     ));
    // }

    public function testAddsDebugListener()
    {
        $em = new Emitter();
        $r = new ClientResolver(ClientResolver::getDefaultArguments());
        $r->resolve([
            'service'  => 'blackbox',
            'region'   => 'x',
            'debug'    => true,
            'endpoint' => 'http://sandboxapi.via.de:8001',
            'version'  => 'latest',
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
            'service'  => 'blackbox',
            'region'   => 'x',
            'debug'    => false,
            'endpoint' => 'http://sandboxapi.via.de:8001',
            'version'  => 'latest',
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
            'service' => 'blackbox',
            'region'  => 'x',
            'version' => 'latest',
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
            'service' => 'blackbox',
            'region'  => 'x',
            'version' => 'latest',
            'http'    => ['foo' => 'bar'],
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
