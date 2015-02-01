<?php
namespace Vws\Credentials;

use Vws\Vdk;

class Credentials implements CredentialsInterface
{

    private $username;
    private $password;
    private $token;
    private $vendor;
    private $version;

    public function __construct($username, $password, $token, $vendor = 'vws-php', $version = Vdk::VERSION)
    {
        $this->username = trim($username);
        $this->password = trim($password);
        $this->token = trim($token);
        $this->vendor = trim($vendor);
        $this->version = trim($version);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSubscriptionToken()
    {
        return $this->getToken();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getVendor()
    {
        return $this->vendor;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function toArray()
    {
        return [
            'Username'     => $this->username,
            'Password'  => $this->password,
            'SubscriptionToken'   => $this->token,
            'Vendor' => $this->vendor,
            'Version' => $this->version
        ];
    }
}
