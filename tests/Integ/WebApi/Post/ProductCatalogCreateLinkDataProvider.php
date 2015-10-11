<?php

namespace Vws\Test\Integ\WebApi\Post;

use GuzzleHttp\Collection;

trait ProductCatalogCreateLinkDataProvider
{
    private $catalogGuids = [];
    private $productGuids = [];

    public static function productCatalogCreateLinkData()
    {
        return array_merge(
            self::emptyProductForeignId(),
            self::nullProductForeignId(),
            self::invalidProductForeignId(),
            self::greaterThan60CharsProductForeignId(),
            // CatalogForeignId
            self::emptyCatalogForeignId(),
            self::nullCatalogForeignId(),
            self::invalidCatalogForeignId(),
            self::greaterThan60CharsCatalogForeignId(),
            // valid assignments
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
                    'StatusCode' => 404,
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
                    'StatusCode' => 404,
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
                            'Severity' => 2,
                            'Message' => 'productForeignId does not exists.',
                            'Description' => 'The \'productForeignId\': (.+) does not exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function greaterThan60CharsProductForeignId()
    {
        return
        [
            [
                [
                    117699
                ],
                [
                    self::randStrGen(61, false)
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4026,
                            'Severity' => 2,
                            'Message' => '(.+) is empty or not unique.',
                            'Description' => 'The \'(.+)\': (.+)  is too long. '
                                            .'Maximum length for \'(.+)\' is 60 chars.',
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
                    'StatusCode' => 404,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4022,
                            'Severity' => 2,
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
                    'StatusCode' => 404,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 4022,
                            'Severity' => 2,
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
                            'Severity' => 2,
                            'Message' => 'catalogForeignId does not exists.',
                            'Description' => 'The \'catalogForeignId\': (.+) does not exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    public static function greaterThan60CharsCatalogForeignId()
    {
        return
        [
            [
                [
                    self::randStrGen(61, false)
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
                            'Code' => 4026,
                            'Severity' => 2,
                            'Message' => '(.+) is empty or not unique.',
                            'Description' => 'The \'(.+)\': (.+)  is too long. '
                                            .'Maximum length for \'(.+)\' is 60 chars.',
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
                            'Severity' => 2,
                            'Message' => 'Assignment already exists.',
                            'Description' => 'The assignment of the product '
                                            .'(.+): (.+) to the catalog '
                                            .'(.+): (.+) already exists.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private function buildCatalogs($number)
    {
        $catalogs = new Collection();
        $count = $number;
        for ($i = 1; $i <= $count; $i++) {
            $catalog = $this->buildCatalog();
            $catalogs->add($i-1, $product->toArray());
        }
        return $catalogs;
    }

    protected function buildCatalog()
    {
        $this->catalogGuids = [];
        $count = 1;
        for ($i = 1; $i <= $count; $i++) {
            $catalog = new Collection();
            $catalog->set('Name', 'Root ' . $i . ' with products');

            $guid = self::getGUID();
            $this->catalogGuids[] = $guid;
            $catalog->set('ForeignId', $guid);
            for ($x = 1; $x <= $count; $x++) {
                $subCatalog = new Collection();
                $subCatalog->set('Name', 'Child ' . $i . '. ' . $x . '');

                $guid = self::getGUID();
                $this->catalogGuids[] = $guid;
                $subCatalog->set('ForeignId', $guid);
                $catalog->add('ChildCatalogs', $subCatalog);

                for ($y = 1; $y <= $count; $y++) {
                    $subCatalog1 = new Collection();
                    $subCatalog1->set('Name', 'Child ' . $i . '. ' . $x . '. ' . $y . '');

                    $guid = self::getGUID();
                    $this->catalogGuids[] = $guid;
                    $subCatalog1->set('ForeignId', $guid);
                    $subCatalog->add('ChildCatalogs', $subCatalog1);

                    for ($z = 1; $z <= $count; $z++) {
                        $subCatalog2 = new Collection();
                        $subCatalog2->set('Name', 'Child ' . $i . '. ' . $x . '. ' . $y . '. ' . $z . '');

                        $guid = self::getGUID();
                        $this->catalogGuids[] = $guid;
                        $subCatalog2->set('ForeignId', $guid);
                        $subCatalog1->add('ChildCatalogs', $subCatalog2);
                    }
                }
            }
        }
        return $catalog;
    }

    private function buildProducts()
    {
        $products = new Collection();
        $count = 4;
        for ($i = 1; $i <= $count; $i++) {
            $product = $this->buildProduct();
            $products->add($i-1, $product->toArray());
        }
        return $products;
    }

    private function buildProduct($addVariations = false)
    {
        $product = new Collection();
        $product->set('Title', 'ProductName');

        $guid = self::getGUID();
        $this->productGuids[] = $guid;
        $product->set('ForeignId', $guid);
        $product->set('StockAmount', 1);
        $product->set('Price', 1.23);
        $product->set('Description', 'Description');
        $product->set('ShortDescription', 'ShortDescription');

        $images = new Collection();
        $image = new Collection();
        $image->set('ForeignId', self::getGUID());
        $image->set('ImageUrl', 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg');
        $image->set('Type', 2);
        $images->add(0, $image->toArray());
        $product->add('Images', $images->toArray());

        $specifics = new Collection();
        $specific = new Collection();
        $specific->set('ForeignId', self::getGUID());
        $specific->set('Name', 'Marke');
        $specific->set('Value', 'VIA-eBay');
        $specifics->add(0, $specific->toArray());
        $product->add('Specifics', $specifics->toArray());

        $randomValue = mt_rand();
        if (($randomValue&1 && $addVariations == false) || $addVariations == true) {

            $product->remove('StockAmount');
            $product->remove('Price');

            $variations = new Collection();
            $variation = new Collection();
            $variation->set('ForeignId', self::getGUID());
            $variation->set('Price', 1.23);
            $variation->set('StockAmount', 1);
            $variation->set('Sku', self::getGUID());

            $variationSpecifics = new Collection();
            $variationSpecific = new Collection();
            $variationSpecific->set('ForeignId', self::getGUID());
            $variationSpecific->set('Name', 'Farbe');
            $variationSpecific->set('Value', 'rot');

            $variationSpecifics->add(0, $variationSpecific->toArray());
            $variation->add('Specifics', $variationSpecifics->toArray());

            $variations->add(0, $variation->toArray());
            $product->add('Variations', $variations->toArray());
        }

        return $product;
    }
}
