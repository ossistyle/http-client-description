<?php

namespace Vws\Test;

use Vws\Endpoint\EndpointProvider;
use Vws\Endpoint\PatternEndpointProvider;

/**
 * @covers Vws\Endpoint\PatternEndpointProvider
 */
class PatternEndpointProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsNullWhenUnresolved()
    {
        $e = new PatternEndpointProvider(['foo' => ['rules' => []]]);
        $this->assertNull($e(['service' => 'foo', 'region' => 'bar']));
    }

    public function endpointProvider()
    {
        return [
            [
                ['region' => 'sandbox', 'service' => 'webapi'],
                ['endpoint' => 'https://sandboxapi21.via.de'],
            ],
            [
                ['region' => 'production', 'service' => 'webapi', 'scheme' => 'https'],
                ['endpoint' => 'https://ebaywebapi.via.de'],
            ],
            [
                ['region' => 'sandbox', 'service' => 'wcfapi'],
                ['endpoint' => 'https://sandboxapi.via.de/publicapi/v1/api.svc/'],
            ],
            [
                ['region' => 'production', 'service' => 'wcfapi', 'scheme' => 'https'],
                ['endpoint' => 'https://ebayapi.via.de/publicapi/v1/api.svc/'],
            ],
        ];
    }

    /**
     * @dataProvider endpointProvider
     */
    public function testResolvesEndpoints($input, $output)
    {
        // Use the default endpoints file
        $p = EndpointProvider::defaultProvider();
        $this->assertEquals($output, call_user_func($p, $input));
    }
}
