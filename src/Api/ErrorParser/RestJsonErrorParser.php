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

        // Merge in error data from the JSON body
//        if ($json = $data['parsed']) {
//            $data = array_replace($data, $json);
//        }

        return $data;
    }
}
