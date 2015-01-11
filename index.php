<?php

include 'vendor/autoload.php';

use Via\Client as ViaClient;

$client = new ViaClient([
   'username' => '16269:thoffmann@afterbuy.euAPI',
    'password' => 'J9boHhPD@5i9Ndv_',
    'subscription_token' => 'bb4ac61e-7a36-4369-9aed-75b2dd7f7f0d',
    'vendor' => 'via service',
    'version' => 1.0,
    'base_url' => 'http://local.via.de/WebApi/Api',
    'defaults' => ['save_to' => __DIR__.'/request.log', 'timeout' => 1],
    'debug' => true,
    
]);
$catalog = $client->getService('catalog');

try {
    $result = $catalog->post(['name' => 'Foo']);   
    echo "# Command result: \n";
    print_r($result);
}
catch (\Via\Common\Exception\CommandException $e)
{
    echo "<h3>Error Message</h3>";
    print_r($e->getMessage());
    echo "<h3>Request</h3>";
    echo ($e->getRequest());
}

