<?php

namespace Vws\Test\Integ;

use Vws\Sdk;

trait IntegUtils
{
    private static function getSdk(array $args = [])
    {
        return new Sdk($args + [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
            'scheme'  => 'http',
            'validate' => false,
            //'debug'   => true
        ]);
    }

    public static function log($message)
    {
        fwrite(STDERR, date('c').': '.$message."\n");
    }

    /**
     * Get the resource prefix to add to created resources.
     *
     * @return string
     */
    public static function getResourcePrefix()
    {
        if (!isset($_SERVER['PREFIX']) || $_SERVER['PREFIX'] == 'hostname') {
            $_SERVER['PREFIX'] = crc32(gethostname()).rand(0, 10000);
        }

        return $_SERVER['PREFIX'];
    }

    public function getGUID()
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
