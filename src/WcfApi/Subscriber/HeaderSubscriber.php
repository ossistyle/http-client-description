<?php

namespace Vws\WcfApi\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\SubscriberInterface;

class HeaderSubscriber implements SubscriberInterface
{
    public function getEvents()
    {
        return ['prepared' => ['setHeaders', 'first']];
    }

    public function setHeaders(PreparedEvent $event)
    {
        $request = $event->getRequest();
        $request->addHeader('Content-Type', 'application/json');
        $request->addHeader('Accept', 'application/json');
    }
}
