<?php
namespace Vws\Test\Api\ErrorParser;

use Vws\Api\ErrorParser\RestJsonErrorParser;
use GuzzleHttp\Message\MessageFactory;

/**
 * @covers Vws\Api\ErrorParser\RestJsonErrorParser
 * @covers Vws\Api\ErrorParser\JsonParserTrait
 */
class RestJsonErrorParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParsesClientErrorResponses()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 400 Bad Request\r\n" .
            "x-amzn-requestid: xyz\r\n\r\n" .
            '{ "type": "client", "message": "lorem ipsum", "code": "foo" }'
        );

        $parser = new RestJsonErrorParser();
        $this->assertEquals(array(
            'status_code'       => '400',
            //'message'    => 'lorem ipsum',
            'type'       => 'client',
            //'request_id' => 'xyz',
            'parsed'     => [
                'type' => 'client',
                'message' => 'lorem ipsum',
                'code' => 'foo',
            ],
            'messages'     => [],
        ), $parser($response));
    }

    public function testParsesClientErrorResponseWithCodeInHeader()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 400 Bad Request\r\n" .
            "x-amzn-RequestId: xyz\r\n" .
            "x-amzn-ErrorType: foo:bar\r\n\r\n" .
            '{"message": "lorem ipsum"}'
        );

        $parser = new RestJsonErrorParser();
        $this->assertEquals(array(
            'status_code'       => '400',
            //'code'       => 'foo',
            //'message'    => 'lorem ipsum',
            'type'       => 'client',
            //'request_id' => 'xyz',
            'messages' => [],
            'parsed'     => array(
                'message' => 'lorem ipsum',
            )
        ), $parser($response));
    }
}
