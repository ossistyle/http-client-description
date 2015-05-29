<?php

namespace Vws\Test\Integ\Delete;

trait ProductDataProvider
{
    public static function productDeleteData()
    {
        return array_merge(
            self::emptyForeignId(),
            self::missingForeignId(),
            self::invalidForeignId()
        );
    }

    public static function emptyForeignId()
    {
        return
        [
            [

                [
                    'ForeignId' => '',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4028,
                            'Severity' => 2,
                            'Message' => 'ForeignId is invalid.',
                            'Description' => 'The uri parameter \'ForeignId\' is '
                                            .'required and cannot be empty or missing.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingForeignId()
    {
        return
        [
            [

                [

                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4028,
                            'Severity' => 2,
                            'Message' => 'ForeignId is invalid.',
                            'Description' => 'The uri parameter \'ForeignId\' is '
                                            .'required and cannot be empty or missing.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function invalidForeignId()
    {
        return
        [
            [

                [
                    'ForeignId' => 'invalid_foreign_id',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 404,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4029,
                            'Severity' => 2,
                            'Message' => 'ForeignId does not exists.',
                            'Description' => 'The \'ForeignId\': (.+) does not exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }
}
