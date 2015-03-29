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
            $this->zeroStockAmount()
            // $this->emptyPrice(),
            // $this->missingPrice(),
            // $this->zeroPrice(),
            // $this->missingImages(),
            // $this->emptyImages(),
            // $this->missingSpecifics(),
            // $this->emptySpecifics(),
            // $this->missingImagesAndSpecifics()
        );
    }

    public function emptyForeignId()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => '',
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty ForeignId: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4003,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the product with with the title ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingForeignId()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing ForeignId: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4003,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the product with with the title ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function emptyStockAmount()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => '',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty StockAmount: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4004,
                            'Severity' => 2,
                            'Message' => 'Invalid StockAmount',
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingStockAmount()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing StockAmount: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4004,
                            'Severity' => 2,
                            'Message' => 'Invalid StockAmount',
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function zeroStockAmount()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => 0,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'ReturnMessage' => 'Zero StockAmount: Response not correct ',
                    'EntityListCount' => 0
                ],
            ],

        ];
    }

    public function negativStockAmount()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'StockAmount' => -1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Negativ StockAmount: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4004,
                            'Severity' => 2,
                            'Message' => 'Invalid StockAmount',
                            'Description' => 'The StockAmount of the product with ForeignId: (.+) cannot be empty or must be greater\/equal than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function emptyPrice()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => '',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Price: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4005,
                            'Severity' => 2,
                            'Message' => 'Invalid Price',
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingPrice()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Price: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4005,
                            'Severity' => 2,
                            'Message' => 'Invalid Price',
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function zeroPrice()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 0,
                    'StockAmount' => 1,
                    'Ean' => '14352638',
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Zero Price: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 4005,
                            'Severity' => 2,
                            'Message' => 'Invalid Price',
                            'Description' => 'The Price of the product with ForeignId: (.+) cannot be empty or must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingImages()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Images: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function emptyImages()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [],
                    'Specifics' => [
                        [
                            'Name' => 'Marke',
                            'Value' => 'VIA-Ebay'
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Images: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 5000,
                            'Severity' => 1,
                            'Message' => 'No "productImages" defined or empty.',
                            'Description' => 'The product contains no image. It is recommended to add at least one image.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingSpecifics()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'ReturnMessage' => 'Missing Specifics: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications (.+). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function emptySpecifics()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
                    'Description' => 'Beschreibung',
                    'ShortDescription' => 'Kurzbeschreibung',
                    'Price' => 1.23,
                    'Ean' => '14352638',
                    'StockAmount' => 10,
                    'Images' => [
                        [
                            'ForeignId' => $this->getGUID(),
                            'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                            'Type' => 2
                        ],
                    ],
                    'Specifics' => [],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 0,
                    'MessagesCount' => 1,
                    'ReturnMessage' => 'Empty Specifics: Response not correct ',
                    'Messages' => [
                        [
                            'Code' => 6000,
                            'Severity' => 1,
                            'Message' => 'No product specifics defined or empty.',
                            'Description' => 'The product contains no product specifications \(like: Marke: VIA-eBay\). It is recommended to add at least one product specification with the "Name" \'Marke\' and the corresponding "Value".',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ]
                    ]
                ],
            ],

        ];
    }

    public function missingImagesAndSpecifics()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
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
                    'ReturnMessage' => 'Missing Specifics and Images: Response not correct ',
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
                    ]
                ],
            ],

        ];
    }

    public function emptyImagesAndSpecifics()
    {
        return
        [
            [
                // productData empty ForeignId
                [
                    'ForeignId' => $this->getGUID(),
                    'Title' => 'Integration-Smoke-Test 1',
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
                    'ReturnMessage' => 'Empty Images and Specifics: Response not correct ',
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
                    ]
                ],
            ],

        ];
    }
}
