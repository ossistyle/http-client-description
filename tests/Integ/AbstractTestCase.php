<?php

namespace Vws\Test\Integ;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    protected $client;
    protected $actualResponse;
    protected $expectedResponse;

    protected function setUp()
    {
        $this->client = $this->createClient();
        $this->actualResponse = null;
        $this->expectedResponse = null;
    }
}
