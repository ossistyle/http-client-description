<?php
namespace Vws\Api\Parser;

use Vws\Api\Service;

/**
 * @internal
 */
abstract class AbstractParser
{
    /** @var \Vws\Api\Service Representation of the service API*/
    protected $api;

    /**
     * @param Service $api Service description
     */
    public function __construct(Service $api)
    {
        $this->api = $api;
    }
}
