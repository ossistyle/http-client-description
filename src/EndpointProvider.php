<?php
namespace Vws;

use Vws\Exception\UnresolvedEndpointException;
use GuzzleHttp\Utils;

/**
 * Provides endpoints based on a rules configuration file.
 */
class EndpointProvider
{
    /** @var array */
    private $patterns;

    /**
     * @param array $patterns Hash of endpoint patterns mapping to endpoint
     *                        configurations.
     */
    public function __construct(array $patterns)
    {
        $this->patterns = $patterns;
    }

    /**
     * Creates and returns the default RulesEndpointProvider based on the
     * public rule sets.
     *
     * @return self
     */
    public static function fromDefaults()
    {
        $data = [
            'version' => 2,
            'endpoints' => [
                '*/*' => [
                    'endpoint' => '{region}.via.de'
                ],
                'cn-north-1/*' => [
                    'endpoint' => '{service}.{region}.amazonaws.com.cn',

                ]
            ]
        ];
        return new self($data['endpoints']);
    }

    public function __invoke(array $args = [])
    {
        if (!isset($args['service'])) {
            throw new \InvalidArgumentException('Requires a "service" value');
        }

        if (!isset($args['region'])) {
            throw new \InvalidArgumentException('Requires a "region" value');
        }

        foreach ($this->getKeys($args['region'], $args['service']) as $key) {
            if (isset($this->patterns[$key])) {
                return $this->expand($this->patterns[$key], $args);
            }
        }

        throw new UnresolvedEndpointException();
    }

    private function expand(array $config, array $args)
    {
        $scheme = isset($args['scheme']) ? $args['scheme'] : 'https';
        $config['endpoint'] = $scheme . '://' . Utils::uriTemplate($config['endpoint'], $args);

        return $config;
    }

    private function getKeys($region, $service)
    {
        return ["$region/$service", "$region/*", "*/$service", "*/*"];
    }
}
