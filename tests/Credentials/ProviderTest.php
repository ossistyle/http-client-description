<?php

namespace Vws\Test\Credentials;

use Vws\Credentials\Provider;
use Vws\Credentials\Credentials;

/**
 * @covers \Vws\Credentials\Provider
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    private $workingDir;
    private $username;
    private $password;
    private $subscription_token;
    private $profile;

    private function clearEnv()
    {
        putenv(Provider::ENV_USERNAME . '=');
        putenv(Provider::ENV_PASSWORD . '=');
        putenv(Provider::ENV_SUBSCRIPTION_TOKEN . '=');
        putenv(Provider::ENV_PROFILE . '=');
    }

    public function setUp()
    {
        $this->workingDir = getcwd();
        $this->username = getenv(Provider::ENV_USERNAME);
        $this->password = getenv(Provider::ENV_PASSWORD);
        $this->subscription_token = getenv(Provider::ENV_SUBSCRIPTION_TOKEN);
        $this->profile = getenv(Provider::ENV_PROFILE);
    }

    public function tearDown()
    {
        putenv(Provider::ENV_USERNAME . '=' . $this->username);
        putenv(Provider::ENV_PASSWORD . '=' . $this->password);
        putenv(Provider::ENV_SUBSCRIPTION_TOKEN . '=' . $this->subscription_token);
        putenv(Provider::ENV_PROFILE . '=' . $this->profile);
    }

    public function testCreatesFromEnvironmentVariables()
    {
        $this->clearEnv();
        putenv(Provider::ENV_USERNAME . '=abc');
        putenv(Provider::ENV_PASSWORD . '=123');
        putenv(Provider::ENV_SUBSCRIPTION_TOKEN . '=token');
        $creds = Provider::resolve(Provider::env());
        $this->assertEquals('abc', $creds->getUsername());
        $this->assertEquals('123', $creds->getPassword());
        $this->assertEquals('token', $creds->getSubscriptionToken());
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresCredentialsAreFound()
    {
        Provider::resolve(
            function () {

            }
        );
    }

    public function testCreatesFromIniFile()
    {
        $this->clearEnv();

        $dir = sys_get_temp_dir() . '/.vws';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $ini = <<<EOT
[default]
vws_username = foo
vws_password = baz
vws_subscription_token = tok
EOT;
        file_put_contents($dir . '/credentials', $ini);
        $creds = Provider::resolve(Provider::ini(null, $dir . '/credentials'));
        $this->assertEquals('foo', $creds->getUsername());
        $this->assertEquals('baz', $creds->getPassword());
        $this->assertEquals('tok', $creds->getSubscriptionToken());
        unlink($dir . '/credentials');
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     * @expectedExceptionMessage Invalid credentials file:
     */
    public function testEnsuresIniFileIsValid()
    {
        $this->clearEnv();
        $dir = sys_get_temp_dir() . '/.vws';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($dir . '/credentials', "foo \n=\nbaz");
        //putenv('HOME=' . dirname($dir));

        try {
            @Provider::resolve(Provider::ini(null, $dir . '/credentials'));
        } catch (\Exception $e) {
            unlink($dir . '/credentials');
            throw $e;
        }
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresIniFileExists()
    {
        $this->clearEnv();
        Provider::resolve(Provider::ini(null, '/does/not/exist'));
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresIniFileIsReadable()
    {
        $this->clearEnv();
        $dir = sys_get_temp_dir() . '/.vws';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($dir . '/credentials', 'foo');
        chmod($dir . '/credentials', 0744);
        try {
            @Provider::resolve(Provider::ini(null, $dir . '/credentials'));
        } catch (\Exception $e) {
            unlink($dir . '/credentials');
            throw $e;
        }
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresProfileIsNotEmpty()
    {
        $this->clearEnv();
        $dir = sys_get_temp_dir() . '/.vws';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $ini = "[default]\nvws_username = foo\n"
            . "vws_password = baz\n[foo]";
        file_put_contents($dir . '/credentials', $ini);
        putenv('HOME=' . dirname($dir));

        try {
            Provider::resolve(Provider::ini('foo'));
        } catch (\Exception $e) {
            unlink($dir . '/credentials');
            throw $e;
        }
    }

    public function testProvidesChains()
    {
        $ar = [];
        $creds = new Credentials('a', 'b', 'c');
        $a = function () use (&$ar) { $ar[] = 'a'; };
        $b = function () use (&$ar) { $ar[] = 'b'; };
        $c = function () use (&$ar) { $ar[] = 'c'; };
        $d = function () use ($creds) { return $creds; };
        $chain = Provider::chain($a, $b, $c, $d);
        $result = $chain();
        $this->assertSame($result, $creds);
        $this->assertEquals(['a', 'b', 'c'], $ar);
    }

    public function testCallsDefaultsCreds()
    {
        $u = getenv(Provider::ENV_USERNAME);
        $p = getenv(Provider::ENV_PASSWORD);
        $t = getenv(Provider::ENV_SUBSCRIPTION_TOKEN);
        putenv(Provider::ENV_USERNAME . '=abc');
        putenv(Provider::ENV_PASSWORD . '=123');
        putenv(Provider::ENV_SUBSCRIPTION_TOKEN . '=token');
        $provider = Provider::defaultProvider();
        $creds = $provider();
        putenv(Provider::ENV_USERNAME . "={$u}");
        putenv(Provider::ENV_PASSWORD . "={$p}");
        putenv(Provider::ENV_SUBSCRIPTION_TOKEN . "={$t}");
        $this->assertEquals('abc', $creds->getUsername());
        $this->assertEquals('123', $creds->getPassword());
        $this->assertEquals('token', $creds->getSubscriptionToken());
    }
}
