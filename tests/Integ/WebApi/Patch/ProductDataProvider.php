<?php

namespace Vws\Test\Integ\WebApi\Patch;

trait ProductDataProvider
{
    public static function productData()
    {
        return array_merge(
            self::emptyForeignIdNoBody(),
            self::missingForeignIdNoBody(),
            self::emptyForeignIdWithBody(),
            self::missingForeignIdWithBody(),
            self::emptyTitle(),
            self::missingTitle(),
            self::greaterThan80CharsTitle(),
            self::exactly80CharsTitle(),
            self::emptyDescription(),
            self::missingDescription(),
            self::emptyShortDescription(),
            self::missingShortDescription(),
            self::greaterThan2000CharsShortDescription(),
            self::emptyPrice(),
            self::missingPrice(),
            self::zeroPrice(),
            self::emptyStockAmount(),
            self::missingStockAmount(),
            self::zeroStockAmount(),
            self::invalidEan(),
            self::emptyEan(),
            self::missingEan(),
            self::invalidUpc(),
            self::emptyUpc(),
            self::missingUpc(),
            self::invalidIsbn(),
            self::emptyIsbn(),
            self::missingIsbn()
        );
    }

    public static function emptyForeignIdNoBody()
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
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingForeignIdNoBody()
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
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function emptyForeignIdWithBody()
    {
        return
        [
            [

                [
                    'ForeignId' => '',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s') . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingForeignIdWithBody()
    {
        return
        [
            [

                [
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s') . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function emptyTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => '',
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4000,
                            'Severity' => 2,
                            'Message' => 'Title cannot be empty.',
                            'Description' => 'The title of the product with the '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => 'patch_standard_product',
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],

        ];
    }

    public static function greaterThan80CharsTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__
                                . ' ' . self::randStrGen(80, true),
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4001,
                            'Severity' => 1,
                            'Message' => 'Title is too long.',
                            'Description' => 'The title of the product with the '
                                            .'(.+): (.+) is too long. '
                                            .'The title has been truncated by 80 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function exactly80CharsTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__
                                . ' ' . self::randStrGen(18, true),
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],

        ];
    }

    public static function emptyDescription()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => '',
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4019,
                            'Severity' => 2,
                            'Message' => 'Description cannot be empty',
                            'Description' => 'The description of the product with the '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingDescription()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function emptyShortDescription()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => '',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function missingShortDescription()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function greaterThan2000CharsShortDescription()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => __FUNCTION__ . ' '
                                        . self::randStrGen(2000, true),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4014,
                            'Severity' => 1,
                            'Message' => 'ShortDescription is too long',
                            'Description' => 'The ShortDescription of the product '
                                            .'with (.+): (.+) is too long. '
                                            .'The ShortDescription has been truncated by 2000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyPrice()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => '',
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4005,
                            'Severity' => 2,
                            'Message' => 'Invalid Price',
                            'Description' => 'The Price of the product with '
                                            .'(.+): (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingPrice()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function zeroPrice()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 0.00,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4005,
                            'Severity' => 2,
                            'Message' => 'Invalid Price',
                            'Description' => 'The Price of the product with '
                                            .'(.+): (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyStockAmount()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => '',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4004,
                            'Severity' => 2,
                            'Message' => 'Invalid StockAmount',
                            'Description' => 'The StockAmount of the product with '
                                            .'(.+): (.+) cannot be empty or must '
                                            .'be greater\/equal than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingStockAmount()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function zeroStockAmount()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 0,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function invalidEan()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => 'abc123',
                    'StockAmount' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4006,
                            'Severity' => 1,
                            'Message' => 'Invalid Ean',
                            'Description' => 'The EAN of the product with '
                                            .'(.+): (.+) is not valid. '
                                            .'Please verify to send a valid EAN with 12 or 13 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyEan()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'Ean' => '',
                    'StockAmount' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function missingEan()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function invalidUpc()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Upc' => 'abc123'
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4007,
                            'Severity' => 1,
                            'Message' => 'Invalid Upc',
                            'Description' => 'The UPC of the product with '
                                            .'(.+): (.+) is not valid. '
                                            .'Please verify to send a valid UPC.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyUpc()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Upc' => ''
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function missingUpc()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function invalidIsbn()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Isbn' => 'abc123'
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4008,
                            'Severity' => 1,
                            'Message' => 'Invalid Isbn',
                            'Description' => 'The ISBN of the product with '
                                            .'(.+): (.+) is not valid. '
                                            .'Please verify to send a valid ISBN-10 or ISBN-13.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyIsbn()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Isbn' => ''
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function missingIsbn()
    {
        return
        [
            [
                [
                    'ForeignId' => 'patch_standard_product',
                    'Title' => 'PATCH Standardproduct ' . date('d-m-Y H:i:s')
                                . ' ' . __FUNCTION__,
                    'Description' => 'Beschreibung ' . date('d-m-Y H:i:s'),
                    'ShortDescription' => 'Kurzbeschreibung ' . date('d-m-Y H:i:s'),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }
}
