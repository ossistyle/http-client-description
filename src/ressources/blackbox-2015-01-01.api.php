<?php

return [
    'metadata' => [
        'apiVersion' => '2015-01-01',
        'serviceFullName' => 'Via Blackbox Service',
        'timestampFormat' => 'rfc822',
        'protocol' => 'rest-json',
        'jsonVersion' => '1.1'
    ],
    'operations' => [
        'GetCatalogs' => [
            'name' => 'GetCatalogs',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'api/Catalogs',
            ],
            'output' => [
              'shape' => 'GetCatalogsOutput',
            ],
        ],
        'GetCatalogById' => [
            'name' => 'GetCatalogById',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'api/Catalogs/{Id}',
            ],
            'input' => [
              'shape' => 'GetCatalogByIdInput',
            ],
            'output' => [
              'shape' => 'GetCatalogByIdOutput',
            ],
        ],
        'PostCatalog' => [
            'name' => 'PostCatalog',
            'http' => [
              'method' => 'POST',
              'requestUri' => 'api/Catalogs',
            ],
            'input' => [
              'shape' => 'PostCatalogInput',
            ],
            'output' => [
              'shape' => 'PostCatalogOutput',
            ]

        ],
        'PostCatalogs' => [
            'name' => 'PostCatalogs',
            'http' => [
              'method' => 'POST',
              'requestUri' => 'api/Catalogs/PostList',
            ],
            'input' => [
              'shape' => 'PostCatalogsInput',
            ],
            'output' => [
              'shape' => 'PostCatalogsOutput',
            ]

        ],
        'PostProduct' => [
            'name' => 'PostProduct',
            'http' => [
              'method' => 'POST',
              'requestUri' => 'api/Products',
            ],
            'input' => [
              'shape' => 'PostProductInput',
            ],
            'output' => [
              'shape' => 'PostProductOutput',
            ]

        ],
    ],
    /***********************************************************************
     *
     *                          SHAPES
     *
     **********************************************************************/


    'shapes' => [

        /**********************************
         *      CATALOGS BEGIN
         *********************************/

        'GetCatalogByIdInput' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri'
                ]
            ],
            'required' => [
              'Id',
            ],
        ],

        'GetCatalogByIdOutput' => [
            'type' => 'structure',
            'members' => [
                'Id' =>  [
                  'shape' => 'IntegerNoMinMax',
                ],
                'Name' => [
                    'shape' => 'StringMin3Max30',
                ],
                'IsRootLevel' => [
                    'shape' => 'Boolean',
                ],
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'ChildCatalogs' => [
                    'shape' => 'CatalogList',
                ],
            ]
        ],

        'GetCatalogsOutput' => [
            'type' => 'list',
            'member' => [
                'shape' => 'Catalog',
            ],
        ],

        'PostCatalogInput' => [
            'type' => 'structure',
            'required' => [
                'Name',
                'ForeignId',
            ],
            'members' => [
                'Name' => [
                    'shape' => 'StringMin3Max30',
                ],
                'IsRootLevel' => [
                    'shape' => 'Boolean',
                ],
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'ChildCatalogs' => [
                    'shape' => 'CatalogList',
                ],
            ]
        ],

        'PostCatalogOutput' => [
            'type' => 'structure',
            'members' => [
                'Id' =>  [
                  'shape' => 'IntegerNoMinMax',
                ],
                'Name' => [
                    'shape' => 'StringMin3Max30',
                ],
                'IsRootLevel' => [
                    'shape' => 'Boolean',
                ],
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'ChildCatalogs' => [
                    'shape' => 'CatalogList',
                ],
            ]
        ],

        'PostCatalogsInput' => [
            'type' => 'list',
            'member' => [
                'shape' => 'PostCatalogInput',
            ],
        ],

        'PostCatalogsOutput' => [
            'type' => 'list',
            'member' => [
                'shape' => 'PostCatalogOutput',
            ],
        ],

        'Catalog' => [
            'type' => 'structure',
            'members' => [
                'Id' =>  [
                  'shape' => 'IntegerNoMinMax',
                ],
                'Name' => [
                    'shape' => 'StringMin3Max30',
                ],
                'IsRootLevel' => [
                    'shape' => 'Boolean',
                ],
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'ChildCatalogs' => [
                    'shape' => 'CatalogList',
                ],
            ]
        ],

        'CatalogList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'Catalog'
            ]
        ],

        /***************************************
         *    CATALOGS END | PRODUCTS BEGIN
         ***************************************/

        'PostProductInput' => [
            'type' => 'structure',
            'required' => [
                'Title',
                'ForeignId',
                'Price',
                'StockAmount'
            ],
            'members' => [
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'Title' => [
                    'shape' => 'StringMin3Max80',
                ],
                'Description' => [
                    'shape' => 'StringNoMinMax',
                ],
                'ShortDescription' => [
                    'shape' => 'StringMax2000',
                ],
                'Price' => [
                    'shape' => 'Float',
                ],
                'Ean' => [
                    'shape' => 'StringEan',
                ],
                'Upc' => [
                    'shape' => 'StringUpc',
                ],
                'Isbn' => [
                    'shape' => 'StringIsbn',
                ],
                'StockAmount' => [
                    'shape' => 'IntegerMax999',
                ],
                'ProductImages' => [
                    'shape' => 'ProductImageList',
                ],
            ]
        ],

        'ProductImageList' => [
            'type' => 'list',
            'maxItems' => 1,
            'minItems' => 1,
            'member' => [
                'shape' => 'ProductImage'
            ]
        ],

        'ProductImage' => [
            'type' => 'structure',
            'required' => [
                'ImageUrl',
                'ForeignId',
                'Type',
            ],
            'members' => [
                'ForeignId' => [
                    'shape' => 'StringMax255',
                ],
                'ImageUrl' => [
                    'shape' => 'Url',
                ],
                'Type' => [
                    'shape' => 'IntegerMin1Max1',
                ],
            ]
        ],

        /**********************************
         *      PRODUCTS END
         *********************************/

       /***********************************************************************
        *
        *                          DATA TYPES
        *
        **********************************************************************/

        'Boolean' => [
            'type' => 'boolean',
        ],

        'Float' => [
            'type' => 'float',
        ],
        'IntegerNoMinMax' => [
            'type' => 'integer',
        ],
        'IntegerMin1Max1' => [
            'type' => 'integer',
            'min' => 1,
            'max' => 1,
        ],
        'IntegerMax999' => [
            'type' => 'integer',
            'max' => 999,
        ],
        'StringEan' => [
            'type' => 'string',
            'pattern' => '#\b[\d\\-]{3,18}\b#',
        ],
        'StringUpc' => [
            'type' => 'string',
            'pattern' => '#^(\\d{8}|\\d{12,14})$#',
        ],
        'StringIsbn' => [
            'type' => 'string',
            'pattern' => '#\b(?:ISBN(?:: ?| ))?((?:97[89])?\d{9}[\dx])\b#i',
        ],
        'StringNoMinMax' => [
            'type' => 'string',
        ],
        'StringMin3Max30' => [
            'type' => 'string',
            'min' => 3,
            'max' => 30,
        ],
        'StringMin3Max80' => [
            'type' => 'string',
            'min' => 3,
            'max' => 80,
        ],
        'StringMax2000' => [
            'type' => 'string',
            'max' => 2000,
        ],
        'StringMax255' => [
            'type' => 'string',
            'max' => 255,
        ],
        'Url' => [
            'type' => 'string',
            'max' => 255,
            'pattern' => '#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#',
            'filters' => [
                [
                    'method' => 'Respect\Validation\Validator::url',
                    'args' => [true, '@value'],
                ]
            ],
        ]
    ]
];

