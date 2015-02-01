<?php
namespace Vws\Test\Credentials;

use Vws\Credentials\NullCredentials;

/**
 * @covers \Vws\Credentials\NullCredentials
 */
class NullCredentialsTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNullish()
    {
        $n = new NullCredentials();
        $this->assertNull($n->getUsername());
        $this->assertNull($n->getPassword());
        $this->assertNull($n->getSubscriptionToken());
        $this->assertSame(
            ['Username' => null, 'Password' => null, 'SubscriptionToken' => null, 'Vendor' => null, 'Version' => null],
            $n->toArray()
        );
    }
}
