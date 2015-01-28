<?php

namespace Vws\Blackbox;

use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Vws\Blackbox\Subscriber\ApplyCredentialsSubscriber;
use Vws\ClientFactory;

class BlackboxFactory extends ClientFactory
{
    protected function createClient(array $args)
    {
        $client = parent::createClient($args);

        $emitter = $client->getEmitter();
        $emitter->attach(new ApplyCredentialsSubscriber($args['credentials']));
        return $client;
    }
}
