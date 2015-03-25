<?php
namespace Vws\Test\Credentials;

use Vws\Credentials\Credentials;

/**
 * @covers \Vws\Credentials\Credentials
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    public function testHasGetters()
    {
        $creds = new Credentials('foo', 'baz', 'tok', 'foo-baz', '1.0.0');
        $this->assertEquals('foo', $creds->getUsername());
        $this->assertEquals('baz', $creds->getPassword());
        $this->assertEquals('tok', $creds->getSubscriptionToken());
        $this->assertEquals('foo-baz', $creds->getVendor());
        $this->assertEquals('1.0.0', $creds->getVersion());
        $this->assertEquals(
            [
            'Username' => 'foo',
            'Password' => 'baz',
            'SubscriptionToken' => 'tok',
            'Vendor' => 'foo-baz',
            'Version' => '1.0.0',
            ],
            $creds->toArray()
        );
    }
}
