<?php

namespace Vws\Test\Integ\WebApi\Delete;

trait CatalogDataProvider
{
    public static function catalogDeleteData()
    {
        return array_merge(
            self::emptyForeignId(),
            self::missingForeignId(),
            self::invalidForeignId()
        );
    }

    public static function catalogCreateDeleteData()
    {
        return array_merge(
            self::createDeleteCatalog()
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
                            'Code' => 3004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is invalid.',
                            'Description' => 'The URI parameter \'ForeignId\' is '
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
                            'Code' => 3004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is invalid.',
                            'Description' => 'The URI parameter \'ForeignId\' is '
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
                            'Code' => 3005,
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

    public static function createDeleteCatalog()
    {
        return
        [
            [
                [
                    [
                        'ForeignId' => self::getGUID(),
                        'Name' => 'Create Delete Catalog',
                        'IsRootLevel' => true,
                        'ChildCatalogs' => [
                            [
                                'Name' => 'CDC Child 1.1',
                                'ForeignId' => self::getGUID(),
                                'IsRootLevel' => false,
                                'ChildCatalogs' => [
                                    [
                                        'Name' => 'CDC Child 1.1.1',
                                        'IsRootLevel' => false,
                                        'ForeignId' => self::getGUID(),
                                        'ChildCatalogs' => [
                                            [
                                                'Name' => 'CDC Child 1.1.1.1',
                                                'IsRootLevel' => false,
                                                'ForeignId' => self::getGUID(),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'Name' => 'CDC Child 2.1',
                                'ForeignId' => self::getGUID(),
                                'IsRootLevel' => false,
                                'ChildCatalogs' => [
                                    [
                                        'Name' => 'CDC Child 2.1.1',
                                        'IsRootLevel' => false,
                                        'ForeignId' => self::getGUID(),
                                        'ChildCatalogs' => [
                                            [
                                                'Name' => 'CDC Child 2.1.1.1',
                                                'IsRootLevel' => false,
                                                'ForeignId' => self::getGUID(),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'ForeignId' => ''
                    ]
                ],
                    [
                    [
                        'Succeeded' => false,
                        'StatusCode' => 201,
                        'FunctionName' => __FUNCTION__,
                        'EntityListCount' => 0,
                        'Messages' => [],
                    ],
                    [
                        'Succeeded' => false,
                        'StatusCode' => 200,
                        'FunctionName' => __FUNCTION__,
                        'EntityListCount' => 0,
                        'Messages' => [],
                    ],
                ],
            ],

        ];
    }
}
