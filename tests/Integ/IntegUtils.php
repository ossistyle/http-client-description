<?php
namespace Vws\Test\Integ;

trait IntegUtils
{
    private static function getVdk()
    {
        return new \Vws\Vdk([
            'region'  => 'local',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
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
