<?php
namespace Vws\Credentials;

use GuzzleHttp\ToArrayInterface;

interface CredentialsInterface extends ToArrayInterface
{
    public function getUsername();

    public function getPassword();

    public function getToken();

}
