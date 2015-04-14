<?php

namespace Vws\Credentials;

class NullCredentials implements CredentialsInterface
{
    public function getUsername()
    {
        return;
    }

    public function getPassword()
    {
        return;
    }

    public function getSubscriptionToken()
    {
        return $this->getToken();
    }

    public function getToken()
    {
        return;
    }

    public function toArray()
    {
        return [
            'Username' => null,
            'Password'  => null,
            'SubscriptionToken' => null,
            'Vendor' => null,
            'Version' => null,
        ];
    }
}
