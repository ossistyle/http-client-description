<?php

namespace Vws\Test\Integ\WebApi\Patch;

trait SalesOrdersDataProvider
{
    public static function salesOrdersData()
    {
        return array_merge(
            self::setForeignOrderIdWithWrongId(),
            self::setForeignOrderIdWithEmptyForeignOrderId(),
            self::setForeignOrderIdWithCorrectId(),
            self::setShippingStatus0(),
            self::setShippingStatus2(),
            self::setShippingStatus0(),
            self::setShippingStatusWrongStatus1()
        );
    }

    private static function setForeignOrderIdWithWrongId()
    {
        return
        [
            [
                [
                    'Id' => 4711,
                    'ForeignOrderId' => self::getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 404,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 2000,
                            'Severity' => 2,
                            'Message' => 'he specified SalesOrderId \'(.+)\' was not found.',
                            'Description' => 'The specified SalesOrderId \'(.+)\' was not found. '
                                            .'Be sure to request the correct SalesOrderId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ]
        ];
    }

    private static function setForeignOrderIdWithEmptyForeignOrderId()
    {
        return
        [
            [
                [
                    'Id' => 4033,
                    'ForeignOrderId' => '',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 2201,
                            'Severity' => 2,
                            'Message' => '"ForeignOrderId" value is empty.',
                            'Description' => '"ForeignOrderId" value is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ]
        ];
    }

    private static function setForeignOrderIdWithCorrectId()
    {
        return
        [
            [
                [
                    'Id' => 4033,
                    'ForeignOrderId' => self::getGUID(),
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [

                    ],
                ],
            ]
        ];
    }

    private static function setShippingStatus2()
    {
        return
        [
            [
                [
                    'Id' => 4033,
                    'ShippingStatus' => 2,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [

                    ],
                ],
            ]
        ];
    }

    private static function setShippingStatus0()
    {
        return
        [
            [
                [
                    'Id' => 4033,
                    'ShippingStatus' => 0,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [

                    ],
                ],
            ]
        ];
    }

    private static function setShippingStatusWrongStatus1()
    {
        return
        [
            [
                [
                    'Id' => 4033,
                    'ShippingStatus' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 2104,
                            'Severity' => 1,
                            'Message' => 'eBay does not allowed partial delivery.',
                            'Description' => 'eBay does not allowed partial delivery. '
                                            .'In this case the whole sales order will be marked as shipped.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ]
        ];
    }
}
