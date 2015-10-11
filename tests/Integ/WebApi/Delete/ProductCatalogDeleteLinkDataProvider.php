<?php

namespace Vws\Test\Integ\WebApi\Delete;

use GuzzleHttp\Collection;

trait ProductCatalogDeleteLinkDataProvider
{
    public static function productCatalogDeleteLinkData()
    {
        return array_merge(
            self::emptyProductForeignId(),
            self::nullProductForeignId(),
            self::invalidProductForeignId(),
            // CatalogForeignId
            self::emptyCatalogForeignId(),
            self::nullCatalogForeignId(),
            self::invalidCatalogForeignId(),
            self::existingAssignment()
        );
    }

    public static function emptyProductForeignId()
    {
        return
        [
            [
                [
                    117699
                ],
                [
                    ''
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4020,
                            'Severity' => 1,
                            'Message' => 'productForeignId is invalid.',
                            'Description' => 'The \'productForeignId\' cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function nullProductForeignId()
    {
        return
        [
            [
                [
                    117699
                ],
                [
                    null
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4020,
                            'Severity' => 1,
                            'Message' => 'productForeignId is invalid.',
                            'Description' => 'The \'productForeignId\' cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function invalidProductForeignId()
    {
        return
        [
            [
                [
                    117699
                ],
                [
                    'invalidProductForeignId'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4021,
                            'Severity' => 1,
                            'Message' => 'productForeignId does not exists.',
                            'Description' => 'The \'productForeignId\' (.+) does not exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function emptyCatalogForeignId()
    {
        return
        [
            [
                [
                    ''
                ],
                [
                    '200_BNW233031'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4022,
                            'Severity' => 1,
                            'Message' => 'catalogForeignId is invalid.',
                            'Description' => 'The \'catalogForeignId\' cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function nullCatalogForeignId()
    {
        return
        [
            [
                [
                    null
                ],
                [
                    '200_BNW233031'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4022,
                            'Severity' => 1,
                            'Message' => 'catalogForeignId is invalid.',
                            'Description' => 'The \'catalogForeignId\' cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function invalidCatalogForeignId()
    {
        return
        [
            [
                [
                    'invalidCatalogForeignId'
                ],
                [
                    '200_BNW233031'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4023,
                            'Severity' => 1,
                            'Message' => 'catalogForeignId does not exists.',
                            'Description' => 'The \'catalogForeignId\' (.+) does not exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function existingAssignment()
    {
        return
        [
            [
                [
                    117760
                ],
                [
                    '200_BNW233031'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4024,
                            'Severity' => 1,
                            'Message' => 'Assignment already exists.',
                            'Description' => 'The assignment of the product (.+): (.+) to the catalog (.+): (.+) already exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }
}
