<?php

namespace Vws\WcfApi\Credentials;

use Vws\Credentials\AbstractCredentials;

class Credentials extends AbstractCredentials
{
    private $username;
    private $password;

    public function __construct($username, $password, $token, $vendor, $version)
    {
        parent::__construct($token, $vendor, $version);
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSecret()
    {
        throw new \BadMethodCallException();
    }
}
