<?php

namespace Vws\Test\Integ\Post;

trait CatalogDataProvider
{
    public static function catalogData()
    {
        return array_merge(
            self::emptyForeignId(),
            self::missingForeignId(),
            self::emptyForeignIdInChildCatalogs(),
            self::missingForeignIdInChildCatalogs(),
            self::emptyName(),
            self::missingName(),
            self::greaterThanThirtyCharsName(),
            self::childCatalogHasRootLevelTrue()
        );
    }

    public static function emptyForeignId()
    {
        return
        [
            [

                [
                    'Name' => 'Root with empty ForeignId',
                    'IsRootLevel' => true,
                    'ForeignId' => '',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3000,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with '
                                            .'the Name: (.+) is empty. '
                                            .'It is recommended to send a unique ForeignId.',
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
                    'Name' => 'Root with missing ForeignId',
                    'IsRootLevel' => true,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3000,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with '
                                            .'the Name: (.+) is empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyForeignIdInChildCatalogs()
    {
        return
        [
            [

                [
                    'Name' => 'Child has empty ForeignId',
                    'ForeignId' => 'root_1',
                    'IsRootLevel' => true,
                    'ChildCatalogs' => [
                        [
                            'Name' => 'Child 1.1',
                            'ForeignId' => 'child_1_1',
                            'IsRootLevel' => false,
                            'ChildCatalogs' => [
                                [
                                    'Name' => 'Child 1.1.1',
                                    'IsRootLevel' => false,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3000,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with '
                                            .'the Name: (.+) is empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingForeignIdInChildCatalogs()
    {
        return
        [
            [

                [
                    'Name' => 'Childs has missing ForeignId',
                    'IsRootLevel' => true,
                    'ChildCatalogs' => [
                        [
                            'Name' => 'Child 1.1',
                            'IsRootLevel' => false,
                            'ChildCatalogs' => [
                                [
                                    'Name' => 'Child 1.1.1',
                                    'IsRootLevel' => false,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3000,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with '
                                            .'the Name: (.+) is empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyName()
    {
        return
        [
            [

                [
                    'Name' => '',
                    'IsRootLevel' => true,
                    'ForeignId' => self::getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3001,
                            'Severity' => 2,
                            'Message' => 'Name is empty.',
                            'Description' => 'The Name of the product with with '
                                            .'the (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingName()
    {
        return
        [
            [

                [
                    'IsRootLevel' => true,
                    'ForeignId' => self::getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected %s actual given %s',
                    'Messages' => [
                        [
                            'Code' => 3001,
                            'Severity' => 2,
                            'Message' => 'Name is empty.',
                            'Description' => 'The Name of the product with with '
                                            .'the (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullName()
    {
        return
        [
            [

                [
                    'Name' => null,
                    'IsRootLevel' => true,
                    'ForeignId' => self::getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected %s actual given %s',
                    'Messages' => [
                        [
                            'Code' => 3001,
                            'Severity' => 2,
                            'Message' => 'Invalid Name.',
                            'Description' => 'The \'Name\' of the product with with '
                                            .'the (.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function greaterThanThirtyCharsName()
    {
        return
        [
            [

                [
                    'Name' => '1 This Catalog.Name is greater than thirty chars',
                    'IsRootLevel' => true,
                    'ForeignId' => self::getGUID(),
                    'ChildCatalogs' => [
                        [
                            'Name' => '1.1 This Catalog.Name is greater than thirty chars',
                            'IsRootLevel' => false,
                            'ForeignId' => self::getGUID(),
                            'ChildCatalogs' => [
                                [
                                    'Name' => '1.1.1 This Catalog.Name is greater than thirty chars',
                                    'IsRootLevel' => false,
                                    'ForeignId' => self::getGUID(),
                                ],
                                [
                                    'Name' => '1.1.2 This Catalog.Name is greater than thirty chars',
                                    'IsRootLevel' => false,
                                    'ForeignId' => self::getGUID(),
                                ]
                            ]
                        ],
                        [
                            'Name' => '1.2 This Catalog.Name is greater than thirty chars',
                            'IsRootLevel' => false,
                            'ForeignId' => self::getGUID(),
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3002,
                            'Severity' => 1,
                            'Message' => 'The Name of the product with with the (.+): (.+) is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer '
                                            .'than 30 chars, because in the eBay shop supports only 30 chars for the name of a catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 3002,
                            'Severity' => 1,
                            'Message' => 'The Name of the product with with the (.+): (.+) is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer '
                                            .'than 30 chars, because in the eBay shop supports only 30 chars for the name of a catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 3002,
                            'Severity' => 1,
                            'Message' => 'The Name of the product with with the (.+): (.+) is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer '
                                            .'than 30 chars, because in the eBay shop supports only 30 chars for the name of a catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 3002,
                            'Severity' => 1,
                            'Message' => 'The Name of the product with with the (.+): (.+) is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer '
                                            .'than 30 chars, because in the eBay shop supports only 30 chars for the name of a catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 3002,
                            'Severity' => 1,
                            'Message' => 'The Name of the product with with the (.+): (.+) is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer '
                                            .'than 30 chars, because in the eBay shop supports only 30 chars for the name of a catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }



    public static function childCatalogHasRootLevelTrue()
    {
        return
        [
            [

                [
                    'Name' => 'Child 1 has Root true',
                    'IsRootLevel' => true,
                    'ForeignId' => 'root_1',
                    'ChildCatalogs' => [
                        [
                            'Name' => 'Child 1.1',
                            'ForeignId' => 'child_1_1',
                            'IsRootLevel' => true,
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Response contains not expected ',
                    'Messages' => [
                        [
                            'Code' => 3003,
                            'Severity' => 1,
                            'Message' => 'ChildCatalogs with property \'IsRootLevel\' : true are not allowed.',
                            'Description' => 'The ChildCatalogs with (.+) : (.+) has \'IsRootLevel\' : true defined. This value was changed automatically to false.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
