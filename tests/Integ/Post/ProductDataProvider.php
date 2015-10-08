<?php

namespace Vws\Test\Integ\Post;

trait ProductDataProvider
{
    public static function productData()
    {
        return array_merge(
            self::emptyForeignId(),
            self::missingForeignId(),
            self::emptyTitle(),
            self::missingTitle(),
            self::nullTitle(),
            self::greaterThan80CharsTitle(),
            self::shorterThan3CharsTitle(),
            self::emptyStockAmount(),
            self::missingStockAmount(),
            self::zeroStockAmount(),
            self::negativStockAmount(),
            self::emptyPrice(),
            self::missingPrice(),
            self::zeroPrice(),
            self::emptyDescription(),
            self::missingDescription(),
            self::greaterThan2000CharsShortDescription(),
            // ean, upc, isbn
            self::invalidEan(),
            self::invalidUpc(),
            self::invalidIsbn(),
            // images
            self::missingImages(),
            self::emptyImages(),
            self::missingImageUrl(),
            self::emptyImageUrl(),
            self::whitespacesAndTabsImageUrl(),
            self::emptyImageType(),
            self::missingImageType(),
            self::invalidImageTypeOne(),
            self::invalidImageTypeZero(),
            self::invalidImageType13(),
            self::duplicateImageType(),
            // specifics
            self::missingSpecifics(),
            self::emptySpecifics(),
            self::emptySpecificsName(),
            self::missingSpecificsName(),
            self::greater40CharsSpecificsName(),
            self::emptySpecificsValue(),
            self::missingSpecificsValue(),
            self::greaterThan50CharsSpecificsValue(),
            self::duplicateSpecificsNameValue(),
            self::moreThanFifteenSpecifics(),
            // images/specifics
            self::missingImagesAndSpecifics(),
            self::emptyImagesAndSpecifics(),
            // iteration
            self::validProductIteration18(),
            // optional attributes
            self::emptyOptionalAttributesForeignId(),
            self::missingOptionalAttributesForeignId(),
            self::nullOptionalAttributesForeignId(),
            self::emptyOptionalAttributesName(),
            self::missingOptionalAttributesName(),
            self::nullOptionalAttributesName(),
            self::emptyOptionalAttributesValue(),
            self::missingOptionalAttributesValue(),
            self::nullOptionalAttributesValue(),
            self::emptyOptionalAttributesNameAndValue(),
            self::missingOptionalAttributesNameAndValue(),
            self::nullOptionalAttributesNameAndValue(),
            self::greaterThan255CharsOptionalAttributesName(),
            self::greaterThan4000AttributesValue(),
            self::tooLongOptionalAttributesNameAndValue(),
            // Iteration 20
            self::invalidUnitQuantity(),
            self::emptyUnitQuantity(),
            self::missingUnitQuantity(),
            self::emptyUnitType(),
            self::missingUnitType(),
            self::notMappedUnitType(),
            self::validProductIteration20(),
            // Iteration 21
            self::duplicateOptionalAttributesName()
        );
    }

    public static function productDataForExternalUser()
    {
        return array_merge(
            self::emptyExternalProductId(),
            self::missingExternalProductId(),
            self::nullExternalProductId()
        );
    }

    public static function emptyForeignId()
    {
        return
        [
            [

                [
                    'ForeignId' => '',
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 1,
                    'Messages' => [],
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
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 1,
                    'Messages' => [],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => '',
                    'Description' => 'Beschreibung ' . __FUNCTION__,
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The title of the product with the (.+): (.+) cannot be empty.',
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
                    'ForeignId' => self::getGUID(),
                    //'Title' => '',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The title of the product with the (.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function nullTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => null,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The title of the product with '
                                            .'the (.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test with a title greater than eigthy chars validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4001,
                            'Severity' => 1,
                            'Message' => 'Title is too long.',
                            'Description' => 'The title of the product with '
                                            .'the (.+): (.+) is too long. '
                                            .'The title has been truncated by 80 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function shorterThan3CharsTitle()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'ba',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4002,
                            'Severity' => 2,
                            'Message' => 'Title is too short.',
                            'Description' => 'The title of the product with '
                                            .'the (.+): (.+) is too short. '
                                            .'Please verify to send a title with '
                                            .'more than 3 chars and lower equal than 80 chars.',
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
                    'ForeignId' => self::getGUID(),
                    'Title' => self::randStrGen(80),
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => '',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 0,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],

        ];
    }

    public static function negativStockAmount()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => -1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => '',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 0,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The description of the product with the ForeignId: (.+) cannot be empty.',
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
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
                            'Description' => 'The description of the product with the ForeignId: (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => self::randStrGen(2001),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4014,
                            'Severity' => 1,
                            'Message' => 'ShortDescription is too long',
                            'Description' => 'The ShortDescription of the product with ForeignId: {.+} is too long. The ShortDescription has been truncated by 2000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function exactly2000CharsShortDescription()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => self::randStrGen(2000),
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4006,
                            'Severity' => 1,
                            'Message' => 'Invalid Ean',
                            'Description' => 'The EAN of the product with ForeignId: (.+) is not valid. Please verify to send a valid EAN with 12 or 13 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Upc' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4007,
                            'Severity' => 1,
                            'Message' => 'Invalid Upc',
                            'Description' => 'The UPC of the product with ForeignId: (.+) is not valid. Please verify to send a valid UPC.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
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
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Isbn' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4008,
                            'Severity' => 1,
                            'Message' => 'Invalid Isbn',
                            'Description' => 'The ISBN of the product with ForeignId: (.+) is not valid. Please verify to send a valid ISBN-10 or ISBN-13.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingImages()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product with the (.+): (.+) contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function emptyImages()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product with the (.+): (.+) contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'Messages' => [
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications (.+). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function emptySpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'Messages' => [
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications \(like: Marke: VIA-eBay\). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingImagesAndSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product with the (.+): (.+) contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications \(like: Marke: VIA-eBay\). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function emptyImagesAndSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [],
                    'Specifics' => [],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product with the (.+): (.+) contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications \(like: Marke: VIA-eBay\). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5001,
                            'Severity' => 2,
                            'Message' => 'ImageUrl cannot be empty.',
                            'Description' => 'The productImage ImageUrl of the product with the ForeignId: (.+) cannot be empty',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => '',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5001,
                            'Severity' => 2,
                            'Message' => 'ImageUrl cannot be empty.',
                            'Description' => 'The productImage ImageUrl of the product with the ForeignId: (.+) cannot be empty',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function whitespacesAndTabsImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => '         ',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5001,
                            'Severity' => 2,
                            'Message' => 'ImageUrl cannot be empty.',
                            'Description' => 'The productImage ImageUrl of the product with the ForeignId: (.+) cannot be empty',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => '',
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5002,
                            'Severity' => 2,
                            'Message' => 'Type cannot be empty.',
                            'Description' => 'The productImage Type of the product with the ForeignId: (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5002,
                            'Severity' => 2,
                            'Message' => 'Type cannot be empty.',
                            'Description' => 'The productImage Type of the product with the ForeignId: (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function invalidImageTypeOne()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 1,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5003,
                            'Severity' => 2,
                            'Message' => 'Invalid "Type" value.',
                            'Description' => 'The productImage "Type" of the product with the ForeignId: (.+) is not valid. Please check our documentation for the allowed values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function invalidImageTypeZero()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 0,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5003,
                            'Severity' => 2,
                            'Message' => 'Invalid "Type" value.',
                            'Description' => 'The productImage "Type" of the product with the ForeignId: (.+) is not valid. Please check our documentation for the allowed values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function invalidImageType13()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 13,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5003,
                            'Severity' => 2,
                            'Message' => 'Invalid "Type" value.',
                            'Description' => 'The productImage "Type" of the product with the ForeignId: (.+) is not valid. Please check our documentation for the allowed values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function moreThan11ValidImage()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_5.jpg',
                            'Type' => 5,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_6.jpg',
                            'Type' => 6,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_7.jpg',
                            'Type' => 7,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_8.jpg',
                            'Type' => 8,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_9.jpg',
                            'Type' => 9,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_10.jpg',
                            'Type' => 10,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 11,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 12,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 13,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5003,
                            'Severity' => 2,
                            'Message' => 'Invalid "Type" value.',
                            'Description' => 'The productImage "Type" of the product with the ForeignId: (.+) is not valid. Please check our documentation for the allowed values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 5004,
                            'Severity' => 2,
                            'Message' => 'Too many images provided for the product.',
                            'Description' => 'The maximum number of images for the product with the (.+): (.+) is limited to 11.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function duplicateImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_5.jpg',
                            'Type' => 5,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_6.jpg',
                            'Type' => 6,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_7.jpg',
                            'Type' => 7,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_8.jpg',
                            'Type' => 8,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_9.jpg',
                            'Type' => 9,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_10.jpg',
                            'Type' => 10,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 11,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 5005,
                            'Severity' => 2,
                            'Message' => 'Images contains duplicate "Type" value.',
                            'Description' => 'The images of the product with the ForeignId: (.+) contains duplicate "Type". Be sure to use unique "Type" values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptySpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => '',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6001,
                            'Severity' => 2,
                            'Message' => 'Empty product specifics name.',
                            'Description' => 'The property "Name" is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingSpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6001,
                            'Severity' => 2,
                            'Message' => 'Empty product specifics name.',
                            'Description' => 'The property "Name" is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function greater40CharsSpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Specifics Name greater than forthy characters',
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6003,
                            'Severity' => 2,
                            'Message' => 'The value of "Name" is too long.',
                            'Description' => 'The value of the property "Name" is greater than 40 characters.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function exactly40CharsSpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => self::randStrGen(40),
                            'Value' => 'VIA-Ebay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function emptySpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => '',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6004,
                            'Severity' => 2,
                            'Message' => 'The value of "Value" is empty.',
                            'Description' => 'The value of the property "Value" is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingSpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6004,
                            'Severity' => 2,
                            'Message' => 'The value of "Value" is empty.',
                            'Description' => 'The value of the property "Value" is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function greaterThan50CharsSpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'Is that a greater than fifty character Specifics.Value?',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6005,
                            'Severity' => 1,
                            'Message' => 'The value of "Value" has been truncated.',
                            'Description' => 'The value of the property "Value" is greater than 50 characters and has been truncated.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function exactly50CharsSpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => self::randStrGen(50),
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function duplicateSpecificsNameValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6002,
                            'Severity' => 2,
                            'Message' => 'Identical values in product specifics name.',
                            'Description' => 'The property "Name" on product specifics is not unique. Be sure to submit unique values for the property "Name".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function moreThanFifteenSpecifics()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke1',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Marke2',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke3',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke4',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke5',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke6',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke7',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke8',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke9',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke10',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke11',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke12',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke13',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke14',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke15',
                            'Value' => 'VIA-eBay',
                        ],
                        [
                            'Name' => 'Marke16',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 6006,
                            'Severity' => 1,
                            'Message' => 'Contains more than 15 Specifics.',
                            'Description' => 'The product contains more than 15 Specifics. eBay only supports 15 Specifics. So you only will see 15 Specifics on eBay.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function validProductIteration18()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Valide Product Iteration 18',
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function emptyExternalProductId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'ExternalProductId' => '',
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4026,
                            'Severity' => 1,
                            'Message' => 'ExternalProductId is invalid.',
                            'Description' => 'The \'ExternalProductId\' of the product with the (.+): (.+) cannot be empty. It is required to send a unique ExternalProductId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingExternalProductId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4026,
                            'Severity' => 1,
                            'Message' => 'ExternalProductId is invalid.',
                            'Description' => 'The \'ExternalProductId\' of the product with the (.+): (.+) cannot be empty. It is required to send a unique ExternalProductId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullExternalProductId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'ExternalProductId' => null,
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4026,
                            'Severity' => 1,
                            'Message' => 'ExternalProductId is invalid.',
                            'Description' => 'The \'ExternalProductId\' of the product with the (.+): (.+) cannot be empty. It is required to send a unique ExternalProductId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => '',
                            'Name' => '2 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7000,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the '
                                            .'OptionalProductAttributes cannot be empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'Name' => '2 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7000,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the '
                                            .'OptionalProductAttributes cannot be empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => null,
                            'Name' => '2 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7000,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the '
                                            .'OptionalProductAttributes cannot be empty. '
                                            .'It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7001,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Name is empty.',
                            'Description' => 'The \'Name\' of the OptionalProductAttributes '
                                            .'with (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7001,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Name is empty.',
                            'Description' => 'The \'Name\' of the OptionalProductAttributes '
                                            .'with (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => null,
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7001,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Name is empty.',
                            'Description' => 'The \'Name\' of the OptionalProductAttributes '
                                            .'with (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyOptionalAttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '2 OptionalAttributes',
                            'Value' => ''
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7002,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Value is empty.',
                            'Description' => 'The \'Value\' of the OptionalProductAttributes '
                                        .'with (.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingOptionalAttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '2 OptionalAttributes',
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7002,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Value is empty.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullOptionalAttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '2 OptionalAttributes',
                            'Value' => null
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7002,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Value is empty.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '',
                            'Value' => ''
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7006,
                            'Severity' => 2,
                            'Message' => 'Name and value are empty.',
                            'Description' => 'Product (.+): Both, OptionalProductAttributes.Name '
                                            .'and OptionalProductAttributes.Value of the '
                                            .'OptionalProductAttributes with the ForeignId: '
                                            .'(.+) are empty. The product has not been created.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID()
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7006,
                            'Severity' => 2,
                            'Message' => 'Name and value are empty.',
                            'Description' => 'Product (.+): Both, OptionalProductAttributes.Name '
                                            .'and OptionalProductAttributes.Value of the '
                                            .'OptionalProductAttributes with the ForeignId: '
                                            .'(.+) are empty. The product has not been created.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => null,
                            'Value' => null
                        ]
                    ]
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7006,
                            'Severity' => 2,
                            'Message' => 'Name and value are empty.',
                            'Description' => 'Product (.+): Both, OptionalProductAttributes.Name '
                                            .'and OptionalProductAttributes.Value of the '
                                            .'OptionalProductAttributes with the ForeignId: '
                                            .'(.+) are empty. The product has not been created.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function greaterThan255CharsOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(256),
                            'Value' => self::randStrGen(300)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7004,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Name is too long.',
                            'Description' => 'The \'Name\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. The \'Name\' '
                                            .'has been truncated by 255 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function exactly255CharsOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(300)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function greaterThan4000AttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => 'Lorem ipsum dolor sit amet,
                                        consectetuer adipiscing elit.
                                        Aenean commodo ligula eget dolor. Aenean massa.
                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis,
                                        ultricies nec, pellentesque eu, pretium quis, sem.
                                        Nulla consequat massa quis enim. Donec pede justo,
                                        fringilla vel, aliquet nec, vulputate eget, arcu.
                                        In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                        Nullam dictum felis eu pede mollis pretium. Integer tincidunt.
                                        Cras dapibus. Vivamus elementum semper nisi.
                                        Aenean vulputate eleifend tellus. Aenean leo ligula,
                                        porttitor eu, consequat vitae, eleifend ac, enim.
                                        Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                                        Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.
                                        Aenean imperdiet. Etiam ultricies nisi vel augue.
                                        Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.
                                        Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
                                        sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel,
                                        luctus pulvinar, hendrerit id, lorem.
                                        Maecenas nec odio et ante tincidunt tempus.
                                        Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                        Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.
                                        Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                                        Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
                                        quis gravida magna mi a libero. Fusce vulputate eleifend sapien.
                                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.
                                        Nullam accumsan lorem in dui.
                                        Cras ultricies mi eu turpis hendrerit fringilla.
                                        Vestibulum ante ipsum primis in
                                        faucibus orci luctus et ultrices posuere cubilia Curae;
                                        In ac dui quis mi consectetuer lacinia.'
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '2 OptionalAttributes',
                            'Value' => self::randStrGen(4001)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7005,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Value is too long.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'The \'Value\' has been truncated by 4000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function exactly4000AttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(30),
                            'Value' => self::randStrGen(4000)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(30),
                            'Value' => self::randStrGen(4000)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function tooLongOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(256),
                            'Value' => self::randStrGen(4001)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7004,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Name is too long.',
                            'Description' => 'Product (.+): The \'Name\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. The \'Name\' '
                                            .'has been truncated by 255 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 7005,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Value is too long.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. The \'Value\' '
                                            .'has been truncated by 4000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function invalidUnitQuantity()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => 'foo',
                    'UnitType' => '100ml'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4012,
                            'Severity' => 2,
                            'Message' => 'UnitQuantity invalid.',
                            'Description' => 'The \'UnitQuantity\' of the product '
                                            .'with the (.+): (.+) is empty, but the '
                                            .'\'UnitType\' has a valid value. '
                                            .'Be sure to provide values in both '
                                            .'properties \'UnitQuantity\' and \'UnitType\' '
                                            .'or do not send any of both properties.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyUnitQuantity()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => '',
                    'UnitType' => '100ml'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4012,
                            'Severity' => 2,
                            'Message' => 'UnitQuantity invalid.',
                            'Description' => 'The \'UnitQuantity\' of the product '
                                            .'with the (.+): (.+) is empty, but the '
                                            .'\'UnitType\' has a valid value. '
                                            .'Be sure to provide values in both '
                                            .'properties \'UnitQuantity\' and \'UnitType\' '
                                            .'or do not send any of both properties.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingUnitQuantity()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitType' => '100ml'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4012,
                            'Severity' => 2,
                            'Message' => 'UnitQuantity invalid.',
                            'Description' => 'The \'UnitQuantity\' of the product '
                                            .'with the (.+): (.+) is empty, but the '
                                            .'\'UnitType\' has a valid value. '
                                            .'Be sure to provide values in both '
                                            .'properties \'UnitQuantity\' and \'UnitType\' '
                                            .'or do not send any of both properties.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyUnitType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => '1.5',
                    'UnitType' => ''
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4011,
                            'Severity' => 2,
                            'Message' => 'UnitType invalid.',
                            'Description' => 'The \'UnitType\' of the product '
                                            .'with the (.+): (.+) is empty, '
                                            .'but the \'UnitQuantity\' has a valid value. '
                                            .'Be sure to provide values in both '
                                            .'properties \'UnitQuantity\' and \'UnitType\' '
                                            .'or do not send any of both properties',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingUnitType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => '1.5',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4011,
                            'Severity' => 2,
                            'Message' => 'UnitType invalid.',
                            'Description' => 'The \'UnitType\' of the product '
                                            .'with the (.+): (.+) is empty, '
                                            .'but the \'UnitQuantity\' has a valid value. '
                                            .'Be sure to provide values in both '
                                            .'properties \'UnitQuantity\' and \'UnitType\' '
                                            .'or do not send any of both properties',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function notMappedUnitType()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => '1.5',
                    'UnitType' => 'foo'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4027,
                            'Severity' => 1,
                            'Message' => 'UnitType cannot be mapped.',
                            'Description' => 'The \'UnitType\' of the product '
                                            .'with the (.+): (.+) cannot be mapped '
                                            .'against our mapping table. In this case '
                                            .'you will not have any unit price info on '
                                            .'your eBay item. Please send an E-Mail to our support, '
                                            .'so that we can add your \'UnitType\': (.+) to our mapping table.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function validProductIteration20()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Valide Product Iteration 20',
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => '1 OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => self::randStrGen(255),
                            'Value' => self::randStrGen(4000)
                        ]
                    ],
                    'UnitQuantity' => '1.5',
                    'UnitType' => 'L'

                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],
        ];
    }

    public static function duplicateOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '<h1>HTML Ipsum Presents</h1>

                                    <p><strong>Pellentesque habitant morbi
                                    tristique</strong> senectus et netus et
                                    malesuada fames ac turpis egestas.
                                    Vestibulum tortor quam, feugiat vitae,
                                    ultricies eget, tempor sit amet, ante.
                                    Donec eu libero sit amet quam egestas semper.
                                    <em>Aenean ultricies mi vitae est.</em>
                                    Mauris placerat eleifend leo.
                                    Quisque sit amet est et sapien
                                    ullamcorper pharetra.
                                    Vestibulum erat wisi, condimentum sed,
                                    <code>commodo vitae</code>,
                                    ornare sit amet, wisi.
                                    Aenean fermentum, elit eget tincidunt
                                    condimentum, eros ipsum rutrum orci,
                                    sagittis tempus lacus enim ac dui.
                                    <a href="#">Donec non enim</a>
                                    in turpis pulvinar facilisis. Ut felis.</p>

                                <h2>Header Level 2</h2>

                                <ol>
                                   <li>Lorem ipsum dolor sit amet,
                                    consectetuer adipiscing elit.</li>
                                   <li>Aliquam tincidunt mauris eu risus.</li>
                                </ol>',
                    'ShortDescription' => '<dl>
                                   <dt>Definition list</dt>
                                   <dd>Consectetur adipisicing elit, sed do
                                   eiusmod tempor incididunt ut labore et
                                   dolore magna aliqua.
                                   Ut enim ad minim veniam, quis
                                   nostrud exercitation ullamco laboris
                                   nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                   <dt>Lorem ipsum dolor sit amet</dt>
                                   <dd>Consectetur adipisicing elit,
                                   sed do eiusmod tempor incididunt ut labore
                                   et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation
                                   ullamco laboris nisi ut aliquip ex ea
                                   commodo consequat.</dd>
                                </dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay',
                        ],
                        [
                            'Name' => 'Hersteller',
                            'Value' => 'VIA-eBay',
                        ],
                    ],
                    'OptionalAttributes' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => 'OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Name' => 'OptionalAttributes',
                            'Value' => self::randStrGen(300)
                        ]
                    ]
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7008,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Name duplicity.',
                            'Description' => 'Product (.+): The \'Name\' of the OptionalProductAttributes '
                                            .'with ForeignId: (.+) alyready exists in database. '
                                            .'The \'Name\' of an OptionalProductAttributes should be unique.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
