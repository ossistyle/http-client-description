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
            $this->missingImages(),
            $this->emptyImages(),
            $this->missingSpecifics(),
            $this->emptySpecifics(),
            $this->missingImagesAndSpecifics(),
            $this->missingImageUrl(),
            $this->whitespacesAndTabsImageUrl(),
            $this->invalidImageTypeOne(),
            $this->invalidImageTypeZero(),
            $this->invalidImageType13(),
            $this->moreThanOneValidImage(),
            $this->emptySpecifics(),
            $this->missingSpecificsName(),
            $this->greater40CharsSpecificsName(),
            $this->emptySpecificsValue(),
            $this->missingSpecificsValue(),
            $this->greaterThan50charsSpecificsValue()
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty ForeignId: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing ForeignId: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty StockAmount: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing StockAmount: Response contains not correct ',
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
                    'ReturnMessage' => 'Zero StockAmount: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Negativ StockAmount: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Price: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Price: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Zero Price: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Images: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product contains no image. It is recommended to add at least one image.',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Images: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product contains no image. It is recommended to add at least one image.',
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
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'ReturnMessage' => 'Missing Specifics: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'ReturnMessage' => 'Empty Specifics: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Specifics and Images: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Images and Specifics: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Imageurl: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Imageurl: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Imageurl: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Invalid Image Type 1: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Invalid Image Type 0: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Invalid Image Type 13: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Invalid Image Type 13: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Specifics.Name: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Specifics.Name: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Greater than 40 chars Specifics.Name: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Specifics.Value: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Specifics.Value: Response contains not correct ',
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
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Greater than fifty chars Specifics.Value: Response contains not correct ',
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
}
