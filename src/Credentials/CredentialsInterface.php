<?php
namespace Vws\Credentials;

interface CredentialsInterface
{
    public function getUsername();

    public function getPassword();

    public function getSecret();

    public function getToken();

    public function getVendor();

    public function getVersion();

    public function toArray();
}
