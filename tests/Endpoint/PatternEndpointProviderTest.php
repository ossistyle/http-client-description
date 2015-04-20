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
                ['region' => 'sandbox', 'service' => 'blackbox'],
                ['endpoint' => 'https://sandboxapi.via.de:8001'],
            ],
            [
                ['region' => 'local', 'service' => 'blackbox', 'scheme' => 'http'],
                ['endpoint' => 'http://local.via.de/WebApi/'],
            ],
            [
                ['region' => 'production', 'service' => 'blackbox', 'scheme' => 'https'],
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