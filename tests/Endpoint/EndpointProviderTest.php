<?php

namespace Vws\Test;

use Vws\Endpoint\EndpointProvider;

/**
 * @covers Vws\Endpoint\EndpointProvider
 */
class EndpointProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Vws\Exception\UnresolvedEndpointException
     */
    public function testThrowsWhenUnresolved()
    {
        EndpointProvider::resolve(function () {}, []);
    }

    /**
     * @expectedException \Vws\Exception\UnresolvedEndpointException
     */
    public function testThrowsWhenNotArray()
    {
        EndpointProvider::resolve(function () { return 'foo'; }, []);
    }

    public function testCreatesDefaultProvider()
    {
        $p = EndpointProvider::defaultProvider();
        $this->assertInstanceOf('Vws\Endpoint\PatternEndpointProvider', $p);
    }

    public function testCreatesProviderFromPatterns()
    {
        $p = EndpointProvider::patterns([
            '*/*' => ['endpoint' => 'foo.com'],
        ]);
        $this->assertInstanceOf('Vws\Endpoint\PatternEndpointProvider', $p);
        $result = EndpointProvider::resolve($p, []);
        $this->assertEquals('https://foo.com', $result['endpoint']);
    }
}
