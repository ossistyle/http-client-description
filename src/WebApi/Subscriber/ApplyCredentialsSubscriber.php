<?php

namespace Vws\WebApi\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\SubscriberInterface;
use Vws\Credentials\Credentials;

class ApplyCredentialsSubscriber implements SubscriberInterface
{
    /** @var Credentials **/
    private $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getEvents()
    {
        return ['prepared' => ['setCredentials', 'first']];
    }

    public function setCredentials(PreparedEvent $event)
    {
        $request = $event->getRequest();
        $request->addHeaders($this->credentials->toArray());
    }
}
