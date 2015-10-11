<?php

namespace Vws\Api\ErrorParser;

use GuzzleHttp\Message\ResponseInterface;

/**
 * Parsers JSON-RPC errors.
 */
class JsonRpcErrorParser
{
    use JsonParserTrait;

    public function __invoke(ResponseInterface $response)
    {
        $data = $this->genericHandler($response);
        // Make the casing consistent across services.
        if ($data['parsed'] && is_array($data['parsed'])) {
            $data['parsed'] = array_change_key_case($data['parsed']);
        }

        $data['messages'] = isset($data['parsed']['messages'])
            ? $data['parsed']['messages']
            : null;

        return $data;
    }
}
