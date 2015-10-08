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
                ['endpoint' => 'https://dus-bb-api802.dus.via.de/api/'],
            ],
            [
                ['region' => 'local', 'service' => 'webapi', 'scheme' => 'http'],
                ['endpoint' => 'http://local.via.de/WebApi/api/'],
            ],
            [
                ['region' => 'production', 'service' => 'webapi', 'scheme' => 'https'],
                ['endpoint' => 'https://ebay.api.via.de'],
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
