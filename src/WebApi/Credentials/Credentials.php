<?php

namespace Vws\WebApi\Credentials;

use Vws\Credentials\AbstractCredentials;

/**
 *
 */
class Credentials extends AbstractCredentials
{
    private $secret;

    public function __construct($secret, $token, $vendor, $version)
    {
        parent::__construct($token, $vendor, $version);
        $this->secret = $secret;
    }

    public function getUsername()
    {
        throw new \BadMethodCallException();
    }

    public function getPassword()
    {
        throw new \BadMethodCallException();
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function toArray()
    {
        return [
            'Secret' => $this->getSecret(),
            'SubscriptionToken' => $this->getToken(),
            'Vendor' => $this->getVendor(),
            'Version' => $this->getVersion(),
        ];
    }
}
