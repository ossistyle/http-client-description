<?php
namespace Vws\Credentials;


class Credentials implements CredentialsInterface
{
    private $username;
    private $password;
    private $token;

    public function __construct($username, $password, $token)
    {
        $this->username = trim($username);
        $this->password = trim($password);
        $this->token = trim($token);        
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function toArray()
    {
        return [
            'Username'     => $this->username,
            'Password'  => $this->password,
            'SubscriptionToken'   => $this->token,            
        ];
    }
}
