<?php
namespace Vws\Credentials;

use Vws\Sdk;

Abstract class AbstractCredentials implements CredentialsInterface
{
    private $token;
    private $vendor;
    private $version;

    public function __construct($token, $vendor, $version)
    {
        $this->token = trim($token);
        $this->vendor = trim($vendor);
        $this->version = trim($version);
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
}
