<?php

namespace Vws\WcfApi\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\SubscriberInterface;
use Vws\Credentials\Credentials;

class SubscriptionTokenSubscriber implements SubscriberInterface
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
        if (strtolower($event->getCommand()->getName()) !== 'getcookie') {
            $request->addHeader('SubscriptionToken', $this->credentials->getSubscriptionToken());
        } else {
            $request->removeHeader('SubscriptionToken');
        }
    }
}
