<?php
namespace Vws\Test\Api;

use Vws\Api\ApiProvider;
use Vws\Exception\UnresolvedApiException;

/**
 * @covers Vws\Api\ApiProvider
 */
class ApiProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ApiProvider;
     */
    private function getTestApiProvider($useManifest = true)
    {
        $dir = __DIR__ . '/api_provider_fixtures';
        $manifest = include $dir . '/api-version-manifest.php';

        return $useManifest
            ? ApiProvider::manifest($dir, $manifest)
            : ApiProvider::filesystem($dir);
    }

    public function testCanResolveProvider()
    {
        $p = function ($a, $b, $c) {return [];};
        $this->assertEquals([], ApiProvider::resolve($p, 't', 's', 'v'));

        $p = function ($a, $b, $c) {return null;};
        $this->setExpectedException(UnresolvedApiException::class);
        ApiProvider::resolve($p, 't', 's', 'v');
    }

    public function testCanGetServiceVersions()
    {
        $mp = $this->getTestApiProvider();
        $this->assertEquals(
            ['2015-03-27', '2015-02-28'],
            $mp->getVersions('blackbox')
        );
        $this->assertEquals([], $mp->getVersions('foo'));

        $fp = $this->getTestApiProvider(false);
        $this->assertEquals(
            ['2015-03-27', '2015-02-28'],
            $fp->getVersions('blackbox')
        );
    }

    public function testCanGetDefaultProvider()
    {
        $p = ApiProvider::defaultProvider();
        $this->assertArrayHasKey('blackbox', $this->readAttribute($p, 'versions'));
    }

    public function testManifestProviderReturnsNullForMissingService()
    {
        $p = $this->getTestApiProvider();
        $this->assertNull($p('api', 'foo', '2015-02-02'));
    }

    public function testManifestProviderCanLoadData()
    {
        $p = $this->getTestApiProvider();
        $data = $p('api', 'blackbox', 'latest');
        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('foo', $data);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFilesystemProviderEnsuresDirectoryIsValid()
    {
        ApiProvider::filesystem('/path/to/invalid/dir');
    }

    public function testEnsuresValidJson()
    {
        $path = sys_get_temp_dir() . '/invalid-2010-12-05.api.json';
        file_put_contents($path, 'foo, bar');
        $p = ApiProvider::filesystem(sys_get_temp_dir());
        try {
            $p('api', 'invalid', '2010-12-05');
            $this->fail('Did not throw');
        } catch (\Exception $e) {
            $this->assertInstanceOf('InvalidArgumentException', $e);
        } finally {
            unlink($path);
        }
    }

    public function testNullOnMissingFile()
    {
        $p = $this->getTestApiProvider();
        $this->assertNull($p('api', 'nofile', 'latest'));
    }

    public function testReturnsLatestServiceData()
    {
        $p = ApiProvider::filesystem(__DIR__ . '/api_provider_fixtures');
        $this->assertEquals(['foo' => 'bar'], $p('api', 'blackbox', 'latest'));
    }

    public function testCanLoadPhpFile()
    {
        $p = ApiProvider::filesystem(__DIR__ . '/api_provider_fixtures');
        $this->assertEquals(['foo' => 'bar'], $p('api', 'blackbox', '2015-02-28'));
    }

    public function testReturnsNullWhenNoLatestVersionIsAvailable()
    {
        $p = ApiProvider::filesystem(__DIR__ . '/api_provider_fixtures');
        $this->assertnull($p('api', 'dodo', 'latest'));
    }

    public function testReturnsPaginatorConfigsForLatestCompatibleVersion()
    {
        $p = $this->getTestApiProvider();
        $result = $p('paginator', 'blackbox', 'latest');
        $this->assertEquals(['abc' => '123'], $result);
        $result = $p('paginator', 'blackbox', '2015-03-15');
        $this->assertEquals(['abc' => '123'], $result);
    }

    // public function testReturnsWaiterConfigsForLatestCompatibleVersion()
    // {
    //     $p = $this->getTestApiProvider();
    //     $result = $p('waiter', 'dynamodb', 'latest');
    //     $this->assertEquals(['abc' => '456'], $result);
    //     $result = $p('waiter', 'dynamodb', '2011-12-05');
    //     $this->assertEquals(['abc' => '456'], $result);
    // }

    public function testThrowsOnBadType()
    {
        $this->setExpectedException(UnresolvedApiException::class);
        $p = $this->getTestApiProvider();
        ApiProvider::resolve($p, 'foo', 'blackbox', 'latest');
    }

    public function testThrowsOnBadService()
    {
        $this->setExpectedException(UnresolvedApiException::class);
        $p = $this->getTestApiProvider();
        ApiProvider::resolve($p, 'api', '', 'latest');
    }

    public function testThrowsOnBadVersion()
    {
        $this->setExpectedException(UnresolvedApiException::class);
        $p = $this->getTestApiProvider();
        ApiProvider::resolve($p, 'api', 'blackbox', 'derp');
    }
}
