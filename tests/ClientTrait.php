<?php

namespace Vws\Test;

trait ClientTrait
{
    private static function getVdk()
    {
        return new \Vws\Vdk([
            'region'  => 'local',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ]);
    }
}
