<?php

namespace Vws\Blackbox;

use Vws\VwsClient;
use Vws\Blackbox\Subscriber\ApplyCredentialsSubscriber;

/**
 *
 */
class BlackboxClient extends VwsClient
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
        $em->attach(new ApplyCredentialsSubscriber($this->getCredentials()));
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
