<?php

namespace Vws\Test;

use Vws\Vdk;

/**
 * @covers Vws\Vdk
 */
class VdkTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatesClients()
    {
        $this->assertInstanceOf(
            'Vws\VwsClientInterface',
            (new Vdk())->getBlackbox([
                'region'  => 'sandbox',
                'version' => 'latest'
            ])
        );
    }

    public function testEnsureMerge()
    {
        $args = [
            'blackbox' => [],
            'region'  => 'sandbox',
            'version' => 'latest'
        ];
        $this->assertInstanceOf(
            'Vws\VwsClientInterface',
            (new Vdk($args))->getClient('blackbox')
        );
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testEnsuresMissingMethodThrowsException()
    {
        (new Vdk())->foo();
    }

    public function testHasMagicMethods()
    {
        $sdk = $this->getMockBuilder('Vws\Vdk')
            ->setMethods(['getClient'])
            ->getMock();
        $sdk->expects($this->once())
            ->method('getClient')
            ->with('Foo', ['bar' => 'baz']);
        $sdk->getFoo(['bar' => 'baz']);
    }
}
