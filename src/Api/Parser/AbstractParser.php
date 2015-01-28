<?php
namespace Vws\Api\Parser;

use Vws\Api\ServiceModel;

/**
 * @internal
 */
abstract class AbstractParser
{
    /** @var \Aws\Api\Service Representation of the service API*/
    protected $api;

    /**
     * @param ServiceModel $api Service description
     */
    public function __construct(ServiceModel $api)
    {
        $this->api = $api;
    }
}
