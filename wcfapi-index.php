<?php

ini_set('memory_limit', '-1');

// Require the Composer autoloader.
require 'vendor/autoload.php';

use Vws\Blackbox\Exception\WcfApiException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ParseException;

$sdk = new \Vws\Sdk([
  'region'  => 'sandbox',
  'version' => 'latest',
  'profile' => 'sandbox',
  'scheme' => 'http',
  'debug' => false,
  'validate' => false,
  'log' => true,
  'log_filename' => 'wcfapi-' . date('Y-m-d')
]);

try {
    $client = $sdk->createClient('wcfapi');
    $response = $client->getCatalogs();

} catch (ParseException $e) {
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
} catch (WcfApiException $e) {
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
catch (ServerException $e) {
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
catch (\Exception $e) {
    echo '<pre>' . $e->getMessage() . '</pre>';
    echo '<h2>Request</h2>';
    echo '<pre>' . $e->getRequest() . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . $e->getResponse() . '</pre>';
}
