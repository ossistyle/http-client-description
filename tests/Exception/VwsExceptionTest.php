<?php

namespace Vws\Test;

use Vws\Exception\VwsException;
use GuzzleHttp\Command\Command;
use GuzzleHttp\Command\CommandTransaction;
use GuzzleHttp\Message\Response;

/**
 * @covers Vws\Exception\VwsException
 */
class VwsExceptionTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    public function testReturnsClient()
    {
        $client = $this->getTestClient('blackbox');
        $trans = new CommandTransaction($client, new Command('foo'));
        $e = new VwsException('Foo', $trans);
        $this->assertSame($client, $e->getClient());
    }

    public function testProvidesContextShortcuts()
    {
        $coll = ['vws_error' => ['request_id' => '10', 'type' => 'mytype', 'code' => 'mycode']];
        $client = $this->getTestClient('blackbox');
        $trans = new CommandTransaction($client, new Command('foo'), $coll);
        $e = new VwsException('Foo', $trans);
        $this->assertEquals('10', $e->getVwsRequestId());
        $this->assertEquals('10', $e->getRequestId());
        $this->assertEquals('mytype', $e->getVwsErrorType());
        $this->assertEquals('mytype', $e->getExceptionType());
        $this->assertEquals('mycode', $e->getVwsErrorCode());
        $this->assertEquals('mycode', $e->getExceptionCode());
    }

    public function testReturnsServiceName()
    {
        $client = $this->getTestClient('blackbox');
        $trans = new CommandTransaction($client, new Command('foo'));
        $e = new VwsException('Foo', $trans);
        $this->assertSame('blackbox', $e->getServiceName());
    }

    public function testReturnsStatusCode()
    {
        $client = $this->getTestClient('blackbox');
        $trans = new CommandTransaction($client, new Command('foo'));
        $trans->response = new Response(400);
        $e = new VwsException('Foo', $trans);
        $this->assertEquals(400, $e->getStatusCode());
    }
}
