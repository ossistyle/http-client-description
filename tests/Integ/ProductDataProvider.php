<?php

namespace Vws\Test\Integ;

trait ProductDataProvider
{
    public function productData()
    {
        return array_merge(
            $this->emptyForeignId(),
            $this->missingForeignId(),
            $this->emptyStockAmount(),
            $this->missingStockAmount(),
            $this->zeroStockAmount(),
            $this->emptyPrice(),
            $this->missingPrice(),
            $this->zeroPrice(),
            $this->emptyDescription(),
            $this->missingDescription(),
            $this->greaterThan2000CharsShortDescription(),
            $this->invalidEan(),
            $this->invalidUpc(),
            $this->invalidIsbn(),
            $this->missingImages(),
            $this->emptyImages(),
            $this->missingSpecifics(),
            $this->emptySpecifics(),
            $this->missingImagesAndSpecifics(),
            $this->missingImageUrl(),
            $this->whitespacesAndTabsImageUrl(),
            $this->emptyImageType(),
            $this->missingImageType(),
            $this->invalidImageTypeOne(),
            $this->invalidImageTypeZero(),
            $this->invalidImageType13(),
            //$this->moreThanOneValidImage(),
            $this->moreThan11ValidImage(),
            $this->duplicateImageType(),
            $this->emptySpecifics(),
            $this->missingSpecificsName(),
            $this->greater40CharsSpecificsName(),
            $this->emptySpecificsValue(),
            $this->missingSpecificsValue(),
            $this->greaterThan50charsSpecificsValue(),
            $this->duplicateSpecificsNameValue(),
            $this->moreThanFifteenSpecifics(),
            $this->validProductSprint18()
        );
    }

    public function emptyForeignId()
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
                            'ForeignId' => $this->getGUID(),
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
                            'Code' => 4003,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the product with with the title ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public function missingForeignId()
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
                            'ForeignId' => $this->getGUID(),
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
                            'Code' => 4003,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the product with with the title ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public function emptyStockAmount()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => '',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingStockAmount()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function zeroStockAmount()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 0,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function negativStockAmount()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => -1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptyPrice()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => '',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingPrice()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function zeroPrice()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 0,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptyDescription()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => '',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingDescription()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function greaterThan2000CharsShortDescription()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Integer nec odio. Praesent libero.
                    Sed cursus ante dapibus diam. Sed nisi.
                    Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.
                    Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa.
                    Vestibulum lacinia arcu eget nulla.
                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam.
                    In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor.
                    Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.
                    Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.
                    Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                    per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam,
                    a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti.
                    Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices.
                    Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna.
                    Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui.
                    Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum.
                    Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue.
                    Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.
                    Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa.
                    Cras metus. Sed aliquet risus a tortor.
                    Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrice.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidEan()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Ean' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidUpc()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Upc' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidIsbn()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'Price' => 1.23,
                    'StockAmount' => 1,
                    'Isbn' => 'abc123',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingImages()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
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

    public function emptyImages()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
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

    public function missingSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptySpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingImagesAndSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
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

    public function emptyImagesAndSpecifics()
    {
        return
        [
            [

                [
                    'ForeignId' => $this->getGUID(),
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
                            'Description' => 'The product contains no image. It is recommended to add at least one image.',
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

    public function missingImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptyImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function whitespacesAndTabsImageUrl()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptyImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidImageTypeOne()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidImageTypeZero()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function invalidImageType13()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function moreThanOneValidImage()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 3,
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

    public function moreThan11ValidImage()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_5.jpg',
                            'Type' => 5,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_6.jpg',
                            'Type' => 6,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_7.jpg',
                            'Type' => 7,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_8.jpg',
                            'Type' => 8,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_9.jpg',
                            'Type' => 9,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_10.jpg',
                            'Type' => 10,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 11,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 12,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function duplicateImageType()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_4.jpg',
                            'Type' => 4,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_5.jpg',
                            'Type' => 5,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_6.jpg',
                            'Type' => 6,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_7.jpg',
                            'Type' => 7,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_8.jpg',
                            'Type' => 8,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_9.jpg',
                            'Type' => 9,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_10.jpg',
                            'Type' => 10,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptySpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingSpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function greater40CharsSpecificsName()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function emptySpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function missingSpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function greaterThan50CharsSpecificsValue()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function duplicateSpecificsNameValue()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function moreThanFifteenSpecifics()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test validate '.__FUNCTION__,
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
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

    public function validProductSprint18()
    {
        return
        [
            [
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Lipsum',
                    'Description' => '<h1>HTML Ipsum Presents</h1>

<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

<h2>Header Level 2</h2>

<ol>
   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
   <li>Aliquam tincidunt mauris eu risus.</li>
</ol>

<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>

<h3>Header Level 3</h3>

<ul>
   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
   <li>Aliquam tincidunt mauris eu risus.</li>
</ul>

<pre><code>
#header h1 a {
	display: block;
	width: 300px;
	height: 80px;
}
</code></pre>',
                    'ShortDescription' => '<dl>
   <dt>Definition list</dt>
   <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat.</dd>
   <dt>Lorem ipsum dolor sit amet</dt>
   <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
commodo consequat.</dd>
</dl>',
                    'StockAmount' => 1,
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                            'Type' => 2,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                            'Type' => 3,
                        ],
                        [
                            'ForeignId' => $this->getGUID(),
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
}
