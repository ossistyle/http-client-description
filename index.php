<?php

include 'vendor/autoload.php';

use Vws\Vdk;

$client = (new Vdk())->getBlackbox([
                'region'  => 'sandbox',
                'version' => 'latest',
                'credentials' => [
                    'username' => 'foo',
                    'password' => 'bar',
                    'subscription_token' => 'foo_bar'
                ]
            ]);

