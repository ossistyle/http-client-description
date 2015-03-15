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

        if (isset($args['region'])) {
            $args['region']['default'] = 'sandbox';
        }

        return $args;
    }
}
