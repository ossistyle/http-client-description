<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Event;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Event\SubscriberInterface;
use Via\HttpDescription\Response\Catalog;
use GuzzleHttp\Command\Event\PreparedEvent;

/**
 * Description of AuthHandler
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class AuthHandler implements SubscriberInterface
{
    /**
     * @var array User-defined configuration options
     */
    private $options;

    /**
     * @var ClientInterface The HTTP client
     */
    private $httpClient;

    /**
     * @param ClientInterface $httpClient The HTTP client which sends requests
     * @param array $options User-defined options
     * @param Token $token An optional token that has already been
     * issued beforehand
     * @param Catalog $catalog An optional catalog that has already
     * been populated beforehand
     */
    public function __construct(ClientInterface $httpClient, array $options)
    {
        $this->httpClient = $httpClient;
        $this->options = $options;
    }

    public function getEvents()
    {
        return [
            'prepared' => ['onPrepare', 200]
        ];
    }

    /**
     * This method is invoked when the `before` event is dispatched by the
     * HTTP client. The Client passes this object an event (the only argument)
     * which then allows it to modify the request according to how it sees fit.
     *
     * @param PrepareEvent $event The event which contains the request along with
     * other pertinent information. The event is
     * mutable, so it acts as a communication device
     * between objects.
     */
    public function onPrepare(PreparedEvent $event)
    {
        $event->getRequest()->setHeader('Username', $this->options['username']);
        $event->getRequest()->setHeader('Password', $this->options['password']);
        $event->getRequest()->setHeader('SubscriptionToken', $this->options['subscription_token']);
        $event->getRequest()->setHeader('Vendor', $this->options['vendor']);
        $event->getRequest()->setHeader('Version', $this->options['version']);
    }
}
