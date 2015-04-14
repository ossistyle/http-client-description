<?php

namespace Vws\Test\Subscriber;

use Vws\Api\Validator;
use Vws\Subscriber\Validation;
use Vws\Test\UsesServiceTrait;
use GuzzleHttp\Command\CommandTransaction;
use GuzzleHttp\Command\Event\InitEvent;

/**
 * @covers Vws\Subscriber\Validation
 */
class ValidationSubscriberTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Found 2 errors while validating the input provided for the PostCatalog operation:
     */
    public function testValdiatesBeforeSerialization()
    {
        $blackbox = $this->getTestClient('blackbox');
        $api = $blackbox->getApi();
        $command = $blackbox->getCommand('PostCatalog');
        $trans = new CommandTransaction($blackbox, $command);
        $event = new InitEvent($trans);
        $validator = new Validator();
        $validation = new Validation($api, $validator);
        $this->assertNotEmpty($validation->getEvents());
        $validation->onInit($event);
    }
}
