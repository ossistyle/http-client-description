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
        $data['status_code'] = (string) $response->getStatusCode();
        //$data['request_id'] = (string) $response->getHeader('x-request-id');
        $data['parsed'] = $response->json();
        $data['type'] = $data['status_code'][0] == '4' ? 'client' : 'server';
        $data['messages'] = [];

        if (isset($data['parsed']['Messages'])) {
            $messages = $data['parsed']['Messages'];
            foreach ($messages as $key => $message) {
                $data['messages'][] = [
                            'code'        => $message['Code'],
                            'severity'    => $message['Severity'],
                            'message'     => $message['Message'],
                            'description' => $message['Description'],
                        ];
            }
        }

        return $data;
    }
}
