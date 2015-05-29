<?php

namespace Vws\Test\Integ;

use Vws\Sdk;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait IntegUtils
{
    private static $errorMessage = '(%s): Response \'%s\' contains %s %s %s expected %s';

    private static function getSdk(array $args = [])
    {
        return new Sdk($args + [
            'region'        => 'sandbox-new',
            //'region'        => 'local',
            'profile'       => 'integ-sandbox',
            'version'       => 'latest',
            'scheme'        => 'https',
            'log'           => true,
            'log_filename'  => 'blackbox-integration',
            'validate'      => false,
            'http'          => ['verify' => false]
        ]);
    }

    protected static function randStrGen($len, $includeWhiteSpace = true)
    {
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        if ($includeWhiteSpace) {
            $chars = $chars . " ";
        }
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        return $result;
    }

    protected static function createBlackboxClient($args = [])
    {
        $client = self::getSdk()->createBlackbox($args);
        return $client;
    }

    protected static function getCustomErrorMessage($method, $assertType, $expected, $actual, $additional = '')
    {
        $string = '';
        switch($assertType) {
            case 'EntityList':
                $string = sprintf(
                    self::$errorMessage,
                    $method,
                    $assertType,
                    '',
                    $actual,
                    'entry',
                    $expected
                );
                break;
            case 'HeaderStatusCode':
                $string = sprintf(
                    self::$errorMessage,
                    $method,
                    'StatusCode',
                    '',
                    $actual,
                    'StatusCode',
                    $expected
                );
                break;
            case 'Messages':
                $string = sprintf(
                    self::$errorMessage,
                    $method,
                    $assertType,
                    (!empty($additional)) ? '['.$additional.']' : '',
                    $actual,
                    'Message',
                    $expected
                );
                break;
        }

        return $string;
    }

    public static function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid, 12, 4).$hyphen
                .substr($charid, 16, 4).$hyphen
                .substr($charid, 20, 12)
                .chr(125);// "}"
            return $uuid;
        }
    }
}
