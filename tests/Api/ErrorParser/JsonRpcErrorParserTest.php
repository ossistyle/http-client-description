<?php
namespace Vws\Test\Api\ErrorParser;

use Vws\Api\ErrorParser\JsonRpcErrorParser;
use GuzzleHttp\Message\MessageFactory;

/**
 * @covers Vws\Api\ErrorParser\JsonRpcErrorParser
 * @covers Vws\Api\ErrorParser\JsonParserTrait
 */
class JsonRpcErrorParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParsesClientErrorResponses()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 400 Bad Request\r\n" .
            "x-amzn-requestid: xyz\r\n\r\n" .
            '{ "__type": "foo", "message": "lorem ipsum" }'
        );

        $parser = new JsonRpcErrorParser();
        $this->assertEquals(array(
            'code'       => 'foo',
            'message'    => 'lorem ipsum',
            'type'       => 'client',
            //'request_id' => 'xyz',
            'status_code' => '400',
            'messages' => [],
            'parsed'     => array(
                '__type'  => 'foo',
                'message' => 'lorem ipsum'
            )
        ), $parser($response));
    }

    public function testParsesServerErrorResponsesWithMixedCasing()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 500 Internal Server Error\r\n" .
            "x-amzn-requestid: 123\r\n\r\n" .
            '{"__Type": "abc#bazFault", "Message": "dolor"}'
        );

        $parser = new JsonRpcErrorParser();
        $this->assertEquals(array(
            'code'       => 'bazFault',
            'message'    => 'dolor',
            'type'       => 'server',
            //'request_id' => '123',
            'status_code' => '500',
            'messages' => [],
            'parsed'     => array(
                '__type'  => 'abc#bazFault',
                'message' => 'dolor'
            )
        ), $parser($response));
    }
}
