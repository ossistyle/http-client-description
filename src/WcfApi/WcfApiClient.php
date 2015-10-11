<?php

namespace Vws\WcfApi;

use Vws\VwsClient;
use Vws\WcfApi\Subscriber\SubscriptionTokenSubscriber;
use Vws\WcfApi\Subscriber\CookieSubscriber;
use Vws\WcfApi\Subscriber\HeaderSubscriber;
use GuzzleHttp\Subscriber\Cookie;

/**
 *
 */
class WcfApiClient extends VwsClient
{
    /**
     * {@inheritdoc}
     *
     * @param array $args
     */
    public function __construct(array $args)
    {
        parent::__construct($args);
        $em = $this->getEmitter();
        $em->attach(new SubscriptionTokenSubscriber($this->getCredentials()));
        $em->attach(new HeaderSubscriber($this->getCredentials()));
        $this->getHttpClient()->getEmitter()->attach(new Cookie());
        $this->getHttpClient()->getEmitter()->attach(new CookieSubscriber($this->getCredentials()));
    }

    /**
     * {@inheritdoc}
     */
    public static function getArguments()
    {
        $args = parent::getArguments();

        $args['scheme']['default'] = 'http';

        if (isset($args['region'])) {
            $args['region']['default'] = 'sandbox';
        }

        if (isset($args['region'])
            && $args['region'] != 'local') {
            $args['scheme']['default'] = 'https';
        }

        return $args;
    }
}
