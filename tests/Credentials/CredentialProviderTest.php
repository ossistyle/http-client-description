<?php
namespace Vws\Test\Credentials;

use Vws\Credentials\CredentialProvider;
use Vws\Credentials\Credentials;

/**
 * @covers \Vws\Credentials\CredentialProvider
 */
class CredentialProviderTest extends \PHPUnit_Framework_TestCase
{
    private $home;
    private $homedrive;
    private $homepath;
    private $username;
    private $password;
    private $token;
    private $workingDir;

    private function clearEnv()
    {
        putenv(CredentialProvider::ENV_USERNAME . '=');
        putenv(CredentialProvider::ENV_PASSWORD . '=');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN . '=');
        putenv(CredentialProvider::ENV_PROFILE . '=');
    }

    public function setUp()
    {
        $this->home = getenv('HOME');
        $this->homedrive = getenv('HOMEDRIVE');
        $this->homepath = getenv('HOMEPATH');
        $this->workingDir = getcwd();
        $this->username = getenv(CredentialProvider::ENV_USERNAME);
        $this->password = getenv(CredentialProvider::ENV_PASSWORD);
        $this->token = getenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN);
    }

    public function tearDown()
    {
        putenv('HOME=' . $this->home);
        putenv('HOMEDRIVE=' . $this->homedrive);
        putenv('HOMEPATH=' . $this->homepath);
        putenv(CredentialProvider::ENV_USERNAME . '=' . $this->username);
        putenv(CredentialProvider::ENV_PASSWORD . '=' . $this->password);
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN . '=' . $this->token);
    }

    /**
     * @expectedException \Vws\Exception\UnresolvedCredentialsException
     */
    public function testEnsuresCredentialsAreFound()
    {
        CredentialProvider::resolve(function () {
          
        });
    }

    public function testCreatesFromEnvironmentVariables()
    {
        $this->clearEnv();
        putenv(CredentialProvider::ENV_USERNAME . '=abc');
        putenv(CredentialProvider::ENV_PASSWORD . '=123');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN . '=1to2ken3');
        $creds = CredentialProvider::resolve(CredentialProvider::env());
        $this->assertEquals('abc', $creds->getUsername());
        $this->assertEquals('123', $creds->getPassword());
        $this->assertEquals('1to2ken3', $creds->getSubscriptionToken());
    }

    public function testCreatesFromIniFile()
    {
        $this->clearEnv();

        $dir = sys_get_temp_dir() . '/.Vws';
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
        //putenv('HOME=' . dirname($dir));
        $creds = CredentialProvider::resolve(CredentialProvider::ini(null, $dir . '/credentials'));
        $this->assertEquals('foo', $creds->getUsername());
        $this->assertEquals('baz', $creds->getPassword());
        $this->assertEquals('tok', $creds->getSubscriptionToken());
        unlink($dir . '/credentials');
    }

    // /**
    //  * @expectedException \Vws\Exception\UnresolvedCredentialsException
    //  * @expectedExceptionMessage Invalid credentials file:
    //  */
    // public function testEnsuresIniFileIsValid()
    // {
    //     $this->clearEnv();
    //     $dir = sys_get_temp_dir() . '/.vws';
    //
    //     if (!is_dir($dir)) {
    //         mkdir($dir, 0777, true);
    //     }
    //
    //     file_put_contents($dir . '/credentials', "wef \n=\nwef");
    //     //putenv('HOME=' . dirname($dir));
    //
    //     try {
    //         @CredentialProvider::resolve(CredentialProvider::ini(null, $dir . '/credentials'));
    //     } catch (\Exception $e) {
    //         unlink($dir . '/credentials');
    //         throw $e;
    //     }
    // }

    /**
     * @expectedException \Vws\Exception\UnresolvedCredentialsException
     */
    public function testEnsuresIniFileExists()
    {
        $this->clearEnv();
        //putenv('HOME=/does/not/exist');
        CredentialProvider::resolve(CredentialProvider::ini(null, '/does/not/exist'));
    }

    /**
     * @expectedException \Vws\Exception\UnresolvedCredentialsException
     */
    public function testEnsuresProfileIsNotEmpty()
    {
        $this->clearEnv();
        $dir = sys_get_temp_dir() . '/.vws';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $ini = "[default]\vws_username = foo\n"
            . "vws_password = baz\n"
            . "vws_subscription_token = foo_baz\n[foo]";
        file_put_contents($dir . '/credentials', $ini);
        //putenv('HOME=' . dirname($dir));

        try {
            CredentialProvider::resolve(CredentialProvider::ini('foo', $dir . '/credentials'));
        } catch (\Exception $e) {
            unlink($dir . '/credentials');
            throw $e;
        }
    }
    public function testCallsDefaultsCreds()
    {
        $u = getenv(CredentialProvider::ENV_USERNAME);
        $p = getenv(CredentialProvider::ENV_PASSWORD);
        $s = getenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN);
        putenv(CredentialProvider::ENV_USERNAME . '=abc');
        putenv(CredentialProvider::ENV_PASSWORD . '=123');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN . '=1to2ken3');
        $provider = CredentialProvider::defaultProvider();
        $creds = $provider();
        putenv(CredentialProvider::ENV_USERNAME . "={$u}");
        putenv(CredentialProvider::ENV_PASSWORD . "={$p}");
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN . "={$s}");
        $this->assertEquals('abc', $creds->getUsername());
        $this->assertEquals('123', $creds->getPassword());
        $this->assertEquals('1to2ken3', $creds->getSubscriptionToken());
    }
}
