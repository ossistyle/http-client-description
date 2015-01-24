<?php

namespace Vws\Credentials;

class NullCredentials implements CredentialsInterface
{
    public function getUsername()
    {
        return '';
    }

    public function getPassword()
    {
        return '';
    }

    public function getToken()
    {
        return null;
    }

    public function toArray()
    {
        return [
            'Username'     => '',
            'Password'  => '',
            'SubscriptionToken'   => null            
        ];
    }
}
