<?php

namespace Vws\Exception;

use GuzzleHttp\Command\Exception\CommandException;

class VwsException extends CommandException
{
    /**
     * Gets the client that executed the command.
     *
     * @return \Vws\VwsClientInterface
     */
    public function getClient()
    {
        return $this->getTransaction()->serviceClient;
    }

    /**
     * Get the name of the web service that encountered the error.
     *
     * @return string
     */
    public function getServiceName()
    {
        return $this->getClient()->getApi()->getMetadata('endpointPrefix');
    }

    /**
     * If available, gets the HTTP status code of the corresponding response
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->getTransaction()->response
            ? $this->getTransaction()->response->getStatusCode()
            : null;
    }

    /**
     * Get the request ID of the error. This value is only present if a
     * response was received and is not present in the event of a networking
     * error.
     *
     * @return string|null Returns null if no response was received
     */
    public function getVwsRequestId()
    {
        return $this->getTransaction()->context->getPath('vws_error/request_id');
    }

    /**
     * Get the Vws error type.
     *
     * @return string|null Returns null if no response was received
     */
    public function getVwsErrorType()
    {
        return $this->getTransaction()->context->getPath('vws_error/type');
    }

    /**
     * Get the Vws error code.
     *
     * @return string|null Returns null if no response was received
     */
    public function getVwsErrorCode()
    {
        return $this->getTransaction()->context->getPath('vws_error/code');
    }

    /**
     * @deprecated Use getVwsRequestId() instead
     */
    public function getRequestId()
    {
        return $this->getVwsRequestId();
    }

    /**
     * @deprecated Use getVwsErrorCode() instead
     */
    public function getExceptionCode()
    {
        return $this->getVwsErrorCode();
    }

    /**
     * @deprecated Use getVwsErrorType() instead
     */
    public function getExceptionType()
    {
        return $this->getVwsErrorType();
    }
}
