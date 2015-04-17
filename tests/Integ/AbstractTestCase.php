<?php

namespace Vws\Test\Integ;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;
    protected $actualResponse;
    protected $expectedResponse;
}
