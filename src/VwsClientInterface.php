<?php

namespace Vws;

use GuzzleHttp\Command\ServiceClientInterface;

interface VwsClientInterface extends ServiceClientInterface
{
    /**
     * Returns the Vws credentials associated with the client.
     *
     * @return \Vws\Credentials\CredentialsInterface
     */
    public function getCredentials();

    /**
     * Get the region to which the client is configured to send requests.
     *
     * @return string
     */
    public function getRegion();

    /**
     * Gets the default endpoint, or base URL, used by the client.
     *
     * @return string
     */
    public function getEndpoint();

    /**
     * Get the service description associated with the client.
     *
     * @return \Vws\Api\Service
     */
    public function getApi();
}
