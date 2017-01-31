<?php
namespace Vws\Test\Credentials;

use Vws\Credentials\CredentialProvider;

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
        putenv(CredentialProvider::ENV_SECRET.'=');
        putenv(CredentialProvider::ENV_USERNAME.'=');
        putenv(CredentialProvider::ENV_PASSWORD.'=');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'=');
        putenv(CredentialProvider::ENV_PROFILE.'=');
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
        putenv('HOME='.$this->home);
        putenv('HOMEDRIVE='.$this->homedrive);
        putenv('HOMEPATH='.$this->homepath);
        putenv(CredentialProvider::ENV_USERNAME.'='.$this->username);
        putenv(CredentialProvider::ENV_PASSWORD.'='.$this->password);
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'='.$this->token);
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresCredentialsAreFound()
    {
        CredentialProvider::resolve(function () {

        });
    }

    public function testCreatesFromEnvironmentVariables()
    {
        $this->clearEnv();
        putenv(CredentialProvider::ENV_USERNAME.'=user');
        putenv(CredentialProvider::ENV_PASSWORD.'=pass');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'=token');
        putenv(CredentialProvider::ENV_VENDOR.'=vendor');
        putenv(CredentialProvider::ENV_VERSION.'=version');
        $creds = CredentialProvider::resolve(CredentialProvider::env());
        $this->assertEquals('user', $creds->getUsername());
        $this->assertEquals('pass', $creds->getPassword());
        $this->assertEquals('token', $creds->getToken());
        $this->assertEquals('vendor', $creds->getVendor());
        $this->assertEquals('version', $creds->getVersion());
    }

    public function testCreatesFromIniFile()
    {
        $this->clearEnv();

        $dir = sys_get_temp_dir().'/.Vws';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $ini = <<<EOT
[default]
vws_username = user
vws_password = pass
vws_subscription_token = token
vws_vendor = vendor
vws_version = version
EOT;
        file_put_contents($dir.'/credentials', $ini);
        $creds = CredentialProvider::resolve(CredentialProvider::ini(null, $dir.'/credentials'));
        $this->assertEquals('user', $creds->getUsername());
        $this->assertEquals('pass', $creds->getPassword());
        $this->assertEquals('token', $creds->getToken());
        $this->assertEquals('vendor', $creds->getVendor());
        $this->assertEquals('version', $creds->getVersion());
        unlink($dir.'/credentials');
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

        file_put_contents($dir . '/credentials', "wef \n=\nwef");
        //putenv('HOME=' . dirname($dir));

        try {
            @CredentialProvider::resolve(CredentialProvider::ini(null, $dir . '/credentials'));
        } catch (\Exception $e) {
            unlink($dir . '/credentials');
            throw $e;
        }
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     * @expectedExceptionMessage Could not load credentials
     */
    public function testEnsuresIniFileExists()
    {
        $this->clearEnv();
        CredentialProvider::resolve(CredentialProvider::ini(null, '/does/not/exist'));
    }

    /**
     * @expectedException \Vws\Exception\CredentialsException
     */
    public function testEnsuresProfileIsNotEmpty()
    {
        $this->clearEnv();
        $dir = sys_get_temp_dir().'/.vws';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $ini = "[default]\vws_username = user\n"
            ."vws_password = user\n"
            ."vws_subscription_token = token\n"
            ."vws_vendor = vendor\n"
            ."vws_version = version\n[foo]";
        file_put_contents($dir.'/credentials', $ini);

        try {
            CredentialProvider::resolve(CredentialProvider::ini('foo', $dir.'/credentials'));
        } catch (\Exception $e) {
            unlink($dir.'/credentials');
            throw $e;
        }
    }
    public function testCallsDefaultsCreds()
    {
        $u = getenv(CredentialProvider::ENV_USERNAME);
        $p = getenv(CredentialProvider::ENV_PASSWORD);
        $s = getenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN);
        putenv(CredentialProvider::ENV_USERNAME.'=user');
        putenv(CredentialProvider::ENV_PASSWORD.'=pass');
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN.'=token');
        $provider = CredentialProvider::defaultProvider();
        $creds = $provider();
        putenv(CredentialProvider::ENV_USERNAME."={$u}");
        putenv(CredentialProvider::ENV_PASSWORD."={$p}");
        putenv(CredentialProvider::ENV_SUBSCRIPTION_TOKEN."={$s}");
        $this->assertEquals('user', $creds->getUsername());
        $this->assertEquals('pass', $creds->getPassword());
        $this->assertEquals('token', $creds->getToken());
    }
}
