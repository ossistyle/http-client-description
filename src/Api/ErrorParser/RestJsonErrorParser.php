<?php
namespace Vws\Api\ErrorParser;

use GuzzleHttp\Message\ResponseInterface;

/**
 * Parses JSON-REST errors.
 */
class RestJsonErrorParser
{
    use JsonParserTrait;

    public function __invoke(ResponseInterface $response)
    {
        $data = $this->genericHandler($response);

        // Make the casing consistent across services.
        if ($data['parsed'] && is_array($data['parsed'])) {
            $data['parsed'] = array_change_key_case($data['parsed']);
        }

        // Merge in error data from the JSON body
        if ($json = $data['parsed']) {
            $data = array_replace($data, $json);
        }

        return $data;
    }
}
