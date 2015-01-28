<?php

namespace Vws\Test;

use Vws\EndpointProvider;

/**
 * @covers Vws\EndpointProvider
 */
class EndpointProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Vws\Exception\UnresolvedEndpointException
     */
    public function testThrowsWhenEndpointIsNotResolved()
    {
        $e = new EndpointProvider(['foo' => ['rules' => []]]);
        call_user_func($e, ['service' => 'foo', 'region' => 'bar']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Requires a "service" value
     */
    public function testEnsuresService()
    {
        $p = EndpointProvider::fromDefaults();
        call_user_func($p, ['region' => 'foo']);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Requires a "region" value
     */
    public function testEnsuresVersion()
    {
        $p = EndpointProvider::fromDefaults();
        call_user_func($p, ['service' => 'foo']);
    }

    /**
     * @dataProvider endpointProvider
     */
    public function testResolvesEndpoints($input, $output)
    {
        // Use the default endpoints file
        $p = EndpointProvider::fromDefaults();
        $this->assertEquals($output, call_user_func($p, $input));
    }

    public function endpointProvider()
    {
        return [
            [
                ['region' => 'local', 'service' => 'blackbox'],
                ['endpoint' => 'https://local.via.de']
            ],
            [
                ['region' => 'sandbox', 'service' => 'blackbox'],
                ['endpoint' => 'https://sandbox.api.via.de:8001']
            ],
            [
                ['region' => 'production', 'service' => 'blackbox'],
                ['endpoint' => 'https://ebay.api.via.de']
            ],
        ];
    }
}
