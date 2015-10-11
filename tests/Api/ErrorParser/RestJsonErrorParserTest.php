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
            "\r\n\r\n" .
            '{ "Messages": [{"Code": 3000, "Severity": 2, "Message": "foo", "Description": "baz", "UserHelpLink": "", "DeveloperHelpLink": ""}]}'
        );

        $parser = new RestJsonErrorParser();
        $this->assertEquals(array(
            'type'       => 'client',
            'code'       => null,
            'messages' =>
            [
                [
                    'Code' => 3000,
                    'Severity' => 2,
                    'Message' => 'foo',
                    'Description' => 'baz',
                    'UserHelpLink' => null,
                    'DeveloperHelpLink' => null,
                ]
            ],
            'parsed'     =>
            [
                'messages' =>
                    [
                        [
                            'Code' => 3000,
                            'Severity' => 2,
                            'Message' => 'foo',
                            'Description' => 'baz',
                            'UserHelpLink' => null,
                            'DeveloperHelpLink' => null,
                        ]
                    ]
            ]
        ), $parser($response));
    }

    public function testParsesClientErrorResponseWithCodeInHeader()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 400 Bad Request\r\n" .
            "\r\n\r\n" .
            '{}'
        );

        $parser = new RestJsonErrorParser();
        $this->assertEquals(array(
            'code'       => null,
            'messages'    => null,
            'type'       => 'client',
            'parsed'     => []
        ), $parser($response));
    }
}
