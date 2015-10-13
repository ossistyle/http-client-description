<?php

namespace Vws\WcfApi\Subscriber;

use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Event\ErrorEvent;
use Vws\Credentials\Credentials;
use Vws\VwsClientInterface;

class CookieSubscriber implements SubscriberInterface
{
    /** @var Credentials **/
    private $credentials;

    private $commandClient;

    public function __construct(Credentials $credentials, VwsClientInterface $commandClient)
    {
        $this->credentials = $credentials;
        $this->commandClient = $commandClient;
    }

    public function getEvents()
    {
        return [
            'error' => ['onError', 'first'],
        ];
    }

    public function onError(ErrorEvent $event, $name)
    {
        if ($event->getResponse()->getStatusCode() == 401) {

            $params = [
                'userName' => $this->credentials->getUsername(),
                'password' => $this->credentials->getPassword(),
                'createPersistentCookie' => 'false'
            ];

            $this->commandClient->getCookie($params, ['http' => ['cookies' => true]]);

            $newResponse = $event->getClient()->send($event->getRequest());
            // Intercept the original transaction with the new response
            $event->intercept($newResponse);
        }
    }
}
