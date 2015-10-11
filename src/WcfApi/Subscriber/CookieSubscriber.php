<?php

namespace Vws\WcfApi\Subscriber;

use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Event\ErrorEvent;
use Vws\Credentials\Credentials;

class CookieSubscriber implements SubscriberInterface
{
    /** @var Credentials **/
    private $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getEvents()
    {
        return [
            'error' => ['onError', 'first'],
        ];
    }

    public function onError(ErrorEvent $event, $name)
    {
        if ($event->getResponse()->getStatusCode() == 401)
        {
            $request = $event->getClient()->createRequest(
                'POST',
                'http://sandboxapi.via.de/Authentication_JSON_AppService.axd/Login',
                [
                    'cookies' => true,
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'json'  => [
                        'userName' => $this->credentials->getUsername(),
                        'password' => $this->credentials->getPassword(),
                        'createPersistentCookie' => 'false'
                    ],
                ]
            );
            $response = $event->getClient()->send($request);
            $newResponse = $event->getClient()->send($event->getRequest());
            // Intercept the original transaction with the new response
            $event->intercept($newResponse);
        }
    }
}
