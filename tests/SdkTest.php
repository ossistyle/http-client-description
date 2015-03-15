<?php

namespace Vws\Test;

use Vws\Sdk;
use GuzzleHttp\Event\EmitterInterface;
use JmesPath\Env as JmesPath;

/**
 * @covers Vws\Sdk
 */
class SdkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check if the given emitter has the provided event listener
     *
     * @param EmitterInterface $emitter Emitter to search
     * @param string|object    $value   Can be a class name or listener object
     * @param null             $event   Specific event to search (optional)
     *
     * @return bool
     */
    public static function hasListener(
        EmitterInterface $emitter,
        $value,
        $event = null
    )
    {
        $expression = $event
            ? '[*][0]'
            : '*[*][0]';

        $listeners = $event
            ? $emitter->listeners($event)
            : $emitter->listeners();

        $result = JmesPath::search($expression, $listeners) ?: [];

        if (!is_object($value)) {
            $result = array_map(function($o) {
                return get_class($o);
            }, $result);
        }

        return in_array($value, $result, true);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testEnsuresMissingMethodThrowsException()
    {
        (new Sdk())->foo();
    }

    /**
     * [testHasMagicMethods description]
     */
    public function testHasMagicMethods()
    {
        $sdk = $this->getMockBuilder('Vws\Sdk')
            ->setMethods(['createClient'])
            ->getMock();
        $sdk->expects($this->once())
            ->method('createClient')
            ->with('Foo', ['bar' => 'baz']);
        $sdk->createFoo(['bar' => 'baz']);
    }

    /**
     * [testCreatesClients description]
     */
    public function testCreatesClients()
    {
        $this->assertInstanceOf(
            'Vws\VwsClientInterface',
            (new Sdk())->createBlackbox([
                'region'  => 'sandbox',
                'version' => 'latest'
            ])
        );
    }

    /**
     * [testCreatesClientsWithAlias description]
     */
    public function testCreatesClientsWithAlias()
    {
        $this->assertInstanceOf(
            'Vws\VwsClientInterface',
            (new Sdk())->createBlackbox([
                'region'  => 'sandbox',
                'version' => 'latest'
            ])
        );
    }
}

class FooFactory
{
    function create($args) {
        return $args;
    }
}
