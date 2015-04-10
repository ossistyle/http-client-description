<?php

namespace Vws\Test\Integ;

trait ProductVariationDataProvider
{

    public static function productVariationData()
    {
        return array_merge(
            self::emptyVariations(),
            self::nullVariations(),
            self::emptyVariationsForeignId(),
            self::nullVariationsForeignId(),
            self::emptyVariationsPrice(),
            self::nullVariationsPrice(),
            self::missingVariationsPrice(),
            self::emptyVariationsStockAmount(),
            self::missingVariationsStockAmount(),
            self::nullVariationsStockAmount(),
            self::emptyVariationsSpecifics(),
            self::missingVariationsSpecifics(),
            self::nullVariationsSpecifics(),
            self::emptyVariationsSpecificsForeignId(),
            self::missingVariationsSpecificsForeignId(),
            self::nullVariationsSpecificsForeignId(),
            self::emptyVariationsSpecificsName(),
            self::missingVariationsSpecificsName(),
            self::nullVariationsSpecificsName(),
            self::duplicateVariationsSpecificsName(),
            self::emptyVariationsSpecificsValue(),
            self::missingVariationsSpecificsValue(),
            self::nullVariationsSpecificsValue(),
            self::duplicateVariationsSpecificsValue(),
            self::validProductVariationsIteration19()
        );
    }

    public static function emptyVariations()
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
                    'Variations' => []
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 8000,
                            'Severity' => 1,
                            'Message' => 'Variations container is empty.',
                            'Description' => 'The product with the (.+): (.+) is present but empty. The product will be created as a standard product.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariations()
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
                    'Variations' => null
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 8000,
                            'Severity' => 1,
                            'Message' => 'Variations container is empty.',
                            'Description' => 'The product with the (.+): (.+) is present but empty. The product will be created as a standard product.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => '',
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8001,
                            'Severity' => 2,
                            'Message' => 'Variations.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the variation with the Sku: (.+) cannot be empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => null,
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8001,
                            'Severity' => 2,
                            'Message' => 'Variations.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the variation with the Sku: (.+) cannot be empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8001,
                            'Severity' => 2,
                            'Message' => 'Variations.ForeignId is invalid.',
                            'Description' => 'The \'ForeignId\' of the variation with the Sku: (.+) cannot be empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsPrice()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => '',
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8002,
                            'Severity' => 2,
                            'Message' => 'Variations.Price is invalid.',
                            'Description' => 'The \'Price\' of the variation with (.+): (.+) cannot be empty and must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsPrice()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => null,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8002,
                            'Severity' => 2,
                            'Message' => 'Variations.Price is invalid.',
                            'Description' => 'The \'Price\' of the variation with (.+): (.+) cannot be empty and must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsPrice()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'StockAmount' => 1,
                            'Price' => 1.23,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8002,
                            'Severity' => 2,
                            'Message' => 'Variations.Price is invalid.',
                            'Description' => 'The \'Price\' of the variation with (.+): (.+) cannot be empty and must be greater than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsStockAmount()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => '',
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8003,
                            'Severity' => 2,
                            'Message' => 'Variations.StockAmount is invalid.',
                            'Description' => 'The \'StockAmount\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty and must be greater\/equal '
                                            .'than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsStockAmount()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8003,
                            'Severity' => 2,
                            'Message' => 'Variations.StockAmount is invalid.',
                            'Description' => 'The \'StockAmount\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty and must be greater\/equal '
                                            .'than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsStockAmount()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => null,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8003,
                            'Severity' => 2,
                            'Message' => 'Variations.StockAmount is invalid.',
                            'Description' => 'The \'StockAmount\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty and must be greater\/equal '
                                            .'than zero.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsSpecifics()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [],
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
                            'Code' => 8100,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics cannot be empty.',
                            'Description' => 'The \'Specifics\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsSpecifics()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
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
                            'Code' => 8100,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics cannot be empty.',
                            'Description' => 'The \'Specifics\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsSpecifics()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => null
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
                            'Code' => 8100,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics cannot be empty.',
                            'Description' => 'The \'Specifics\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsSpecificsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => '',
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8101,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.ForeignId cannot be empty.',
                            'Description' => 'The \'Specifics.ForeignId\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsSpecificsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8101,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.ForeignId cannot be empty.',
                            'Description' => 'The \'Specifics.ForeignId\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsSpecificsForeignId()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => null,
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8101,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.ForeignId cannot be empty.',
                            'Description' => 'The \'Specifics.ForeignId\' of the '
                                            .'variation with (.+): (.+) cannot '
                                            .'be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsSpecificsName()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => '',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8102,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Name cannot be empty.',
                            'Description' => 'The \'Specifics.Name\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsSpecificsName()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8102,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Name cannot be empty.',
                            'Description' => 'The \'Specifics.Name\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsSpecificsName()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => null,
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8102,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Name cannot be empty.',
                            'Description' => 'The \'Specifics.Name\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function duplicateVariationsSpecificsName()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'L'
                                ]
                            ],
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
                            'Code' => 8103,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Name invalid.',
                            'Description' => 'The \'Specifics.Name\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) has duplicate value.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function emptyVariationsSpecificsValue()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => ''
                                ]
                            ],
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
                            'Code' => 8104,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Value cannot be empty.',
                            'Description' => 'The \'Specifics.Value\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function missingVariationsSpecificsValue()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                ]
                            ],
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
                            'Code' => 8104,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Value cannot be empty.',
                            'Description' => 'The \'Specifics.Value\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function nullVariationsSpecificsValue()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => null
                                ]
                            ],
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
                            'Code' => 8104,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Value cannot be empty.',
                            'Description' => 'The \'Specifics.Value\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function duplicateVariationsSpecificsValue()
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'Blau'
                                ]
                            ],
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
                            'Code' => 8105,
                            'Severity' => 2,
                            'Message' => 'Variations.Specifics.Value invalid.',
                            'Description' => 'The \'Specifics.Value\' of the '
                                            .'variation with the specifics '
                                            .'(.+): (.+) has duplicate values.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function validProductVariationsIteration19()
    {
        return
        [
            [
                [
                    'ForeignId' => self::getGUID(),
                    'Title' => 'Valide ProductVariation Iteration 19',
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
                    'Variations' => [
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.24,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-m-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'M'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.25,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.26,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-xl-blau',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Blau'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'XL'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-rot',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Rot'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.24,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-m-rot',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Rot'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'M'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.25,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-rot',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Rot'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.26,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-xl-rot',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Rot'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'XL'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.23,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-s-gruen',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Grün'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'S'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.24,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-m-gruen',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Grün'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'M'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.25,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-l-gruen',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Grün'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'L'
                                ]
                            ],
                        ],
                        [
                            'ForeignId' => self::getGUID(),
                            'Price' => 1.26,
                            'StockAmount' => 1,
                            'Sku' => 't-shirt-xl-gruen',
                            'Specifics' => [
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Farbe',
                                    'Value' => 'Grün'
                                ],
                                [
                                    'ForeignId' => self::getGUID(),
                                    'Name' => 'Größe',
                                    'Value' => 'XL'
                                ]
                            ],
                        ],
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
}
