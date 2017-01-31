<?php
namespace Vws\Test\WebApi\Credentials\Credentials;

use Vws\WebApi\Credentials\Credentials;

/**
 * @covers \Vws\WebApi\Credentials\Credentials
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    public function testHasGetters()
    {
        $creds = new Credentials('secret', 'tok', 'vendor', '1.0.0');
        $this->assertEquals('secret', $creds->getSecret());
        $this->assertEquals('tok', $creds->getToken());
        $this->assertEquals('vendor', $creds->getVendor());
        $this->assertEquals('1.0.0', $creds->getVersion());
        $this->assertEquals(
            [
            'Secret' => 'secret',
            'SubscriptionToken' => 'tok',
            'Vendor' => 'vendor',
            'Version' => '1.0.0',
            ],
            $creds->toArray()
        );
    }
}
