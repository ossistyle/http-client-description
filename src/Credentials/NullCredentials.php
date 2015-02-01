<?php

namespace Vws\Credentials;

class NullCredentials implements CredentialsInterface
{
    public function getUsername()
    {
        return null;
    }

    public function getPassword()
    {
        return null;
    }

    public function getSubscriptionToken()
    {
        return $this->getToken();
    }

    public function getToken()
    {
        return null;
    }

    public function toArray()
    {
        return [
            'Username' => null,
            'Password'  => null,
            'SubscriptionToken' => null,
            'Vendor' => null,
            'Version' => null
        ];
    }
}
