<?php

namespace Vws\WebApi\Subscriber;

use GuzzleHttp\Command\Event\PreparedEvent;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Message\RequestInterface;
use Vws\WebApi\Credentials\Credentials;

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
        $request->addHeader('SubscriptionToken', $this->credentials->getToken());
        $request->addHeader('Authorization', $this->credentials->getVendor().' '.$this->getAuthorization($request));
    }

    private function getAuthorization(RequestInterface $request)
    {
        $scheme = $request->getScheme();
        $host = $request->getHost();
        $port = $request->getPort();
        $method = $request->getMethod();
        $resource = $request->getResource();
        $body = $request->getBody();

        $message = strtoupper($method).$scheme.'://'.$host.':'.$port.$resource.$body;

        $hash_hmac = hash_hmac('sha512', $message, base64_decode($this->credentials->getSecret()), true);
        $signature = base64_encode($hash_hmac);

        return $signature;
    }
}
