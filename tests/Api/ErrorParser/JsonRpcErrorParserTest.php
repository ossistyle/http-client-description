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
            "\r\n\r\n" .
            '{ "Messages": [{"Code": 3000, "Severity": 2, "Message": "foo", "Description": "baz", "UserHelpLink": "", "DeveloperHelpLink": ""}]}'
        );

        $parser = new JsonRpcErrorParser();
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
            'parsed'     => array(
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
            )
        ), $parser($response));
    }

    public function testParsesServerErrorResponsesWithMixedCasing()
    {
        $response = (new MessageFactory())->fromMessage(
            "HTTP/1.1 500 Internal Server Error\r\n" .
            '{}'
        );

        $parser = new JsonRpcErrorParser();
        $this->assertEquals(array(
            'code'       => null,
            'messages'    => null,
            'type'       => 'server',
            'parsed'     => null
        ), $parser($response));
    }
}
