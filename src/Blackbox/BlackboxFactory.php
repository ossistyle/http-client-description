<?php

namespace Vws\Blackbox;

use Vws\ClientFactory;

class BlackboxFactory extends ClientFactory
{
    protected function createClient(array $args)
    {
        $client = parent::createClient($args);

        $emitter = $client->getEmitter();
        return $client;
    }
}
