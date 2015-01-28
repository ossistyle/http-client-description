<?php
namespace Vws\Api\Serializer;

use Vws\Api\ServiceModel;
use Vws\Api\Operation;
use Vws\Api\Shape;
use Vws\Api\StructureShape;
use Vws\Api\TimestampShape;
use GuzzleHttp\Command\CommandTransaction;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Query;
use GuzzleHttp\Url;
use GuzzleHttp\Stream\Stream;

/**
 * Serializes HTTP locations like header, uri, payload, etc...
 * @internal
 */
abstract class RestSerializer
{
    /** @var Service */
    private $api;

    /** @var Url */
    private $endpoint;

    /** @var callable */
    private $aggregator;

    /**
     * @param Service $api      Service API description
     * @param string  $endpoint Endpoint to connect to
     */
    public function __construct(ServiceModel $api, $endpoint)
    {
        $this->api = $api;
        $this->endpoint = Url::fromString($endpoint);
        $this->aggregator = Query::duplicateAggregator();
    }

    public function getEvents()
    {
        return ['prepared' => ['onPrepare']];
    }

    public function __invoke(CommandTransaction $trans)
    {
        $command = $trans->command;
        $operation = $this->api->getOperation($command->getName());
        $args = $command->toArray();

        $request = $trans->client->createRequest(
            $operation['http']['method'],
            $this->buildEndpoint($operation, $args),
            ['config' => ['command' => $command]]
        );

        // Ensure that query string lists are serialized as duplicates.
        $request->getQuery()->setAggregator($this->aggregator);

        return $this->serialize($request, $operation, $args);
    }

    /**
     * Applies a payload body to a request.
     *
     * @param RequestInterface $request Request to apply.
     * @param StructureShape   $member  Member to serialize
     * @param array            $value   Value to serialize
     *
     * @return \GuzzleHttp\Stream\StreamInterface
     */
    abstract protected function payload(
        RequestInterface $request,
        Shape $member,
        array $value
    );

    private function serialize(
        RequestInterface $request,
        Operation $operation,
        array $args
    ) {
        $input = $operation->getInput();

        // Apply the payload trait if present
        if ($payload = $input['payload']) {
            $this->applyPayload($request, $input, $payload, $args);
        }

        foreach ($args as $name => $value) {
            if ($input->getType() !== 'list')
            {
                if ($input->hasMember($name)) {
                    $member = $input->getMember($name);
                    $location = $member['location'];
                    if (!$payload && !$location) {
                        $bodyMembers[$name] = $value;
                    } elseif ($location == 'header') {
                        $this->applyHeader($request, $name, $member, $value);
                    } elseif ($location == 'querystring') {
                        $this->applyQuery($request, $name, $member, $value);
                    } elseif ($location == 'headers') {
                        $this->applyHeaderMap($request, $name, $member, $value);
                    }
                }
            } else {
                #if (!$payload && !$location) {
                    $bodyMembers[$name] = $value;
                #}
            }
        }

        if (isset($bodyMembers)) {
            $this->payload($request, $operation->getInput(), $bodyMembers);
        }

        return $request;
    }

    private function applyPayload(
        RequestInterface $request,
        Shape $input,
        $name,
        array $args
    ) {
        if (!isset($args[$name])) {
            return;
        }

        $m = $input->getMember($name);

        if ($m['streaming'] ||
           ($m['type'] == 'string' || $m['type'] == 'blob')
        ) {
            // Streaming bodies or payloads that are strings are
            // always just a stream of data.
            $request->setBody(Stream::factory($args[$name]));
        } else {
            $this->payload($request, $m, $args[$name]);
        }
    }

    private function applyHeader(
        RequestInterface $request,
        $name,
        Shape $member,
        $value
    ) {
        if ($member->getType() == 'timestamp') {
            $value = TimestampShape::format($value, 'rfc822');
        }

        $request->setHeader($member['locationName'] ?: $name, $value);
    }

    /**
     * Note: This is currently only present in the Amazon S3 model.
     */
    private function applyHeaderMap(
        RequestInterface $request,
        $name,
        Shape $member,
        array $value
    ) {
        $prefix = $member['locationName'];
        foreach ($value as $k => $v) {
            $request->setHeader($prefix . $k, $v);
        }
    }

    private function applyQuery(
        RequestInterface $request,
        $name,
        Shape $member,
        $value
    ) {
        if ($value !== null) {
            $request->getQuery()->set($member['locationName'] ?: $name, $value);
        }
    }

    /**
     * Builds the URI template for a REST based request.
     *
     * @param Operation $operation
     * @param array     $args
     *
     * @return array
     */
    private function buildEndpoint(Operation $operation, array $args)
    {
        $varspecs = [];

        if ($operation->getInput()->getType() !== 'list') {
            // Create an associative array of varspecs used in expansions
            foreach ($operation->getInput()->getMembers() as $name => $member) {
                if ($member['location'] == 'uri') {
                    $varspecs[$member['locationName'] ?: $name] =
                        isset($args[$name]) ? $args[$name] : null;
                }
            }
        }

        // Expand path place holders using Amazon's slightly different URI
        // template syntax.
        return $this->endpoint->combine(preg_replace_callback(
            '/\{([^\}]+)\}/',
            function (array $matches) use ($varspecs) {
                $isGreedy = substr($matches[1], -1, 1) == '+';
                $k = $isGreedy ? substr($matches[1], 0, -1) : $matches[1];
                if (!isset($varspecs[$k])) {
                    return '';
                } elseif ($isGreedy) {
                    return str_replace('%2F', '/', rawurlencode($varspecs[$k]));
                } else {
                    return rawurlencode($varspecs[$k]);
                }
            },
            $operation['http']['requestUri']
        ));
    }
}
