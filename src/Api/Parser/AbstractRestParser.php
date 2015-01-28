<?php
namespace Vws\Api\Parser;

use Vws\Api\Shape;
use Vws\Api\StructureShape;
use Vws\Result;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @internal
 */
abstract class AbstractRestParser extends AbstractParser
{
    /**
     * Parses a payload from a response.
     *
     * @param ResponseInterface $response Response to parse.
     * @param StructureShape    $member   Member to parse
     * @param array             $result   Result value
     *
     * @return mixed
     */
    abstract protected function payload(
        ResponseInterface $response,
        Shape $member,
        array &$result
    );

    public function __invoke(
        CommandInterface $command,
        ResponseInterface $response
    ) {
        $output = $this->api->getOperation($command->getName())->getOutput();
        $result = [];

        if ($payload = $output['payload']) {
            $this->extractPayload($payload, $output, $response, $result);
        }

        if ($output->getType() !== 'list')
        {
            foreach ($output->getMembers() as $name => $member) {
                switch ($member['location']) {
                    case 'header':
                        $this->extractHeader($name, $member, $response, $result);
                        break;
                    case 'headers':
                        $this->extractHeaders($name, $member, $response, $result);
                        break;
                    case 'statusCode':
                        $this->extractStatus($name, $response, $result);
                        break;
                }
            }
        }

        if (!$payload) {
            // if no payload was found, then parse the contents of the body
            $this->payload($response, $output, $result);
        }

        return new Result($result);
    }

    private function extractPayload(
        $payload,
        StructureShape $output,
        ResponseInterface $response,
        array &$result
    ) {
        $member = $output->getMember($payload);

        if ($member instanceof StructureShape) {
            // Structure members parse top-level data into a specific key.
            $result[$payload] = [];
            $this->payload($response, $member, $result[$payload]);
        } else {
            // Streaming data is just the stream from the response body.
            $result[$payload] = $response->getBody();
        }
    }

    /**
     * Extract a single header from the response into the result.
     */
    private function extractHeader(
        $name,
        Shape $shape,
        ResponseInterface $response,
        &$result
    ) {
        $result[$name] = $response->getHeader($shape['locationName'] ?: $name);
    }

    /**
     * Extract a map of headers with an optional prefix from the response.
     */
    private function extractHeaders(
        $name,
        Shape $shape,
        ResponseInterface $response,
        &$result
    ) {
        // Check if the headers are prefixed by a location name
        $result[$name] = [];
        $prefix = $shape['locationName'];
        $prefixLen = strlen($prefix);

        foreach ($response->getHeaders() as $k => $values) {
            if (!$prefixLen) {
                $result[$name][$k] = implode(', ', $values);
            } elseif (stripos($k, $prefix) === 0) {
                $result[$name][substr($k, $prefixLen)] = implode(', ', $values);
            }
        }
    }

    /**
     * Places the status code of the response into the result array.
     */
    private function extractStatus(
        $name,
        ResponseInterface $response,
        array &$result
    ) {
        $result[$name] = (int) $response->getStatusCode();
    }
}
