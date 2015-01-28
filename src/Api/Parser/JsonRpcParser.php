<?php
namespace Vws\Api\Parser;

use Vws\Api\ServiceModel;
use Vws\Result;
use GuzzleHttp\Command\CommandInterface;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @internal Implements JSON-RPC parsing (e.g., DynamoDB)
 */
class JsonRpcParser extends AbstractParser
{
    private $parser;

    /**
     * @param Service    $api    Service description
     * @param JsonParser $parser JSON body builder
     */
    public function __construct(ServiceModel $api, JsonParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new JsonParser();
    }

    public function __invoke(
        CommandInterface $command,
        ResponseInterface $response
    ) {
        $operation = $this->api->getOperation($command->getName());

        return new Result($this->parser->parse(
            $operation->getOutput(),
            $response->json()
        ));
    }
}
