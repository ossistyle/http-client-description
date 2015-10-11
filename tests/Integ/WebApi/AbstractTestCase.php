<?php

namespace Vws\Test\Integ\WebApi;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;
    protected $actualResponse;
    protected $expectedResponse;
}
