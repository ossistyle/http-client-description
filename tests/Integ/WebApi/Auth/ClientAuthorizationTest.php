<?php

namespace Vws\Test\Integ\WebApi\Auth;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;
use GuzzleHttp\Command\Event\PreparedEvent;

/**
 *
 */
class ClientAuthorizationTest extends ClientAbstractTestCase
{
    use AuthorizationDataProvider;

    /**
     * @dataProvider authorizationData
     *
     */
    public function testAuthorization($callback, $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;
        $callbackName = 'emit' . ucfirst($callback[0]);
        $fnc = $this->{$callbackName}();
        $fnc();
        $this->authValidation('getCatalogs', null);
    }

    private function emitInvalidUsername()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Username', 'invalid-username');
            }, 'last');
        };
    }

    private function emitEmptyUsername()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Username', '');
            }, 'last');
        };
    }

    private function emitMissingUsername()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->removeHeader('Username');
            }, 'last');
        };
    }

    private function emitInvalidPassword()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Password', 'invalid-password');
            }, 'last');
        };
    }

    private function emitEmptyPassword()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Password', '');
            }, 'last');
        };
    }

    private function emitMissingPassword()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->removeHeader('Password');
            }, 'last');
        };
    }

    private function emitInvalidSubscriptionToken()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('SubscriptionToken', 'invalid-subscription-token');
            }, 'last');
        };
    }

    private function emitEmptySubscriptionToken()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('SubscriptionToken', '');
            }, 'last');
        };
    }

    private function emitMissingSubscriptionToken()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->removeHeader('SubscriptionToken');
            }, 'last');
        };
    }

    private function emitEmptyVendor()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Vendor', '');
            }, 'last');
        };
    }

    private function emitMissingVendor()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->removeHeader('Vendor');
            }, 'last');
        };
    }

    private function emitEmptyVersion()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->setHeader('Version', '');
            }, 'last');
        };
    }

    private function emitMissingVersion()
    {
        return function () {
            $this->client->getEmitter()->on('prepared', function (PreparedEvent $event) {
                $request = $event->getRequest();
                $request->removeHeader('Version');
            }, 'last');
        };
    }
}
