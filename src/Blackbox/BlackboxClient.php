<?php

namespace Vws\Blackbox;

use Vws\VwsClient;

class BlackboxClient extends VwsClient
{
    protected function addDefaultArgs(&$args)
    {
        if (!isset($args['region'])) {
            $args['region'] = 'production';
        }

        parent::addDefaultArgs($args);
    }

    protected function createClient(array $args = [])
    {
        $client = parent::createClient($args);
        
        return $client;
    }
}
