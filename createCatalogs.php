<?php

ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 300);
// Require the Composer autoloader.
require 'vendor/autoload.php';
require 'functions.php';
use Vws\Credentials\Credentials;
use GuzzleHttp\Collection;

$sdk = new \Vws\Sdk([
  'region'  => 'sandbox',
  'version' => 'latest',
  'profile' => 'sandbox',
  'scheme' => 'http',
  'debug' => true,
  'validate' => false
]);
$client = $sdk->createClient('Blackbox');

$catalog = new Collection();
$catalog->set('Name', 'Root 1');
$guid = getGUID();
$catalog->set('ForeignId', $guid);
$catalog->set('IsRootLevel', true);

$childCatalogs = new Collection();
$childCatalog = new Collection();

$count=1;

for ($i=1; $i<=110; $i++) {
    $count++;
    $childCatalog->set('Name', 'Child 1.' . ($i+1));
    $guid = getGUID();
    $childCatalog->set('ForeignId', $guid);

    $childCatalogs1 = new Collection();
    $childCatalog1 = new Collection();

    for ($j=1; $j<=150; $j++) {
        $count++;
        $childCatalog1->set('Name', 'Child 1.' . ($i+1) . '.' . ($j+1));
        $guid = getGUID();
        $childCatalog1->set('ForeignId', $guid);
        $childCatalogs1->add($j, $childCatalog1->toArray());
    }
    $childCatalog->add('ChildCatalogs', $childCatalogs1->toArray());
    $childCatalogs->add($i, $childCatalog->toArray());
}

$catalog->add('ChildCatalogs', $childCatalogs->toArray());

echo json_encode($catalog->toArray());

try {
    #$response = $client->postCatalog($catalog->toArray());
    #print_r($response);
} catch (Exception $e) {
    #print_r($e->getMessage());
}
