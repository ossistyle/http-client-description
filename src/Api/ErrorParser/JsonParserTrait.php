<?php
namespace Vws\Api\ErrorParser;

use GuzzleHttp\Message\ResponseInterface;

/**
 * Provides basic JSON error parsing functionality.
 */
trait JsonParserTrait
{
    private function genericHandler(ResponseInterface $response)
    {
        $code = (string) $response->getStatusCode();

        return [
            'code'        => null,
            'messages'    => null,
            'type'        => $code[0] == '4' ? 'client' : 'server',
            'parsed'      => json_decode($response->getBody(), true)
        ];
    }
}
