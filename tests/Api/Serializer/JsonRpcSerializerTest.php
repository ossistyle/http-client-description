<?php
namespace Vws\Test\Api\Serializer;

use Vws\Api\Serializer\JsonRpcSerializer;
use Vws\Api\Service;
use Vws\Test\UsesServiceTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Command;
use GuzzleHttp\Command\CommandTransaction;

/**
 * @covers Vws\Api\Serializer\JsonRpcSerializer
 */
class JsonRpcSerializerTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    public function testPreparesRequests()
    {
        $service = new Service(
            [
                'metadata'=> [
                    'targetPrefix' => 'test',
                    'jsonVersion' => '1.1'
                ],
                'operations' => [
                    'foo' => [
                        'http' => ['httpMethod' => 'POST'],
                        'input' => [
                            'type' => 'structure',
                            'members' => [
                                'baz' => ['type' => 'string']
                            ]
                        ]
                    ]
                ]
            ]
        ,function () {return []; });

        $http = new Client();

        $aws = $this->getMockBuilder('Vws\VwsClient')
            ->setMethods(['getHttpClient'])
            ->disableOriginalConstructor()
            ->getMock();

        $aws->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($http));

        $j = new JsonRpcSerializer($service, 'http://foo.com');
        $trans = new CommandTransaction(
            $aws,
            new Command('foo', ['baz' => 'bam'])
        );
        $trans->request = $j($trans);
        $request = $trans->request;
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('http://foo.com', $request->getUrl());
        $this->assertTrue($request->hasHeader('User-Agent'));
        $this->assertEquals(
            'application/json',
            $request->getHeader('Content-Type')
        );
        $this->assertEquals('{"baz":"bam"}', $request->getBody());
    }
}
