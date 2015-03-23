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
        fwrite(STDERR, date('c') . ': ' . $message . "\n");
    }

    /**
     * Get the resource prefix to add to created resources
     *
     * @return string
     */
    public static function getResourcePrefix()
    {
        if (!isset($_SERVER['PREFIX']) || $_SERVER['PREFIX'] == 'hostname') {
            $_SERVER['PREFIX'] = crc32(gethostname()) . rand(0, 10000);
        }

        return $_SERVER['PREFIX'];
    }
}
