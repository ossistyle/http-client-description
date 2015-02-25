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
              'requestUri' => 'WebApi/api/Catalogs',
            ],
            'output' => [
              'shape' => 'GetCatalogsOutput',
            ],
        ],
        'GetCatalogById' => [
            'name' => 'GetCatalogById',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'WebApi/api/Catalogs/{Id}',
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
              'requestUri' => 'WebApi/api/Catalogs',
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
              'requestUri' => 'WebApi/api/Catalogs/PostList',
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
              'requestUri' => 'WebApi/api/Products',
            ],
            'input' => [
              'shape' => 'PostProductInput',
            ],
            'output' => [
              'shape' => 'PostProductOutput',
            ]

        ],
    ],
    'shapes' => [
        'Catalog' => [
            'type' => 'structure',
            'members' => [
                'Id' =>  [
                  'shape' => 'CatalogId',
                ],
                'Name' => [
                    'shape' => 'CatalogName',
                ],
                'IsRootLevel' => [
                    'shape' => 'CatalogIsRootlevel',
                ],
                'ForeignId' => [
                    'shape' => 'CatalogForeignId',
                ],
                'ChildCatalogs' => [
                    'shape' => 'CatalogList',
                ],
            ]
        ],
        'GetCatalogByIdInput' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'CatalogId',
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
                  'shape' => 'CatalogId',
                ],
                'Name' => [
                    'shape' => 'CatalogName',
                ],
                'IsRootLevel' => [
                    'shape' => 'CatalogIsRootlevel',
                ],
                'ForeignId' => [
                    'shape' => 'CatalogForeignId',
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
                    'shape' => 'CatalogName',
                ],
                'IsRootLevel' => [
                    'shape' => 'CatalogIsRootlevel',
                ],
                'ForeignId' => [
                    'shape' => 'CatalogForeignId',
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
                  'shape' => 'CatalogId',
                ],
                'Name' => [
                    'shape' => 'CatalogName',
                ],
                'IsRootLevel' => [
                    'shape' => 'CatalogIsRootlevel',
                ],
                'ForeignId' => [
                    'shape' => 'CatalogForeignId',
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
                    'shape' => 'ProductForeignId',
                ],
                'Title' => [
                    'shape' => 'ProductTitle',
                ],
                'Description' => [
                    'shape' => 'ProductDescription',
                ],
                'ShortDescription' => [
                    'shape' => 'ProductShortDescription',
                ],
                'Price' => [
                    'shape' => 'Float',
                ],
                'Ean' => [
                    'shape' => 'ProductEan',
                ],
                'Upc' => [
                    'shape' => 'ProductUpc',
                ],
                'Isbn' => [
                    'shape' => 'ProductIsbn',
                ],
                'StockAmount' => [
                    'shape' => 'ProductStockAmount',
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
            ],
            'members' => [
                'ForeignId' => [
                    'shape' => 'ProductImageForeignId',
                ],
                'ImageUrl' => [
                    'shape' => 'ProductImageUrl',
                ],
                'Type' => [
                    'shape' => 'ProductImageType',
                ],
            ]
        ],
        'CatalogForeignId' => [
            'type' => 'string',
            'max' => 255,
        ],
        'CatalogId' => [
            'type' => 'string',
            'max' => 30,
        ],
        'CatalogIsRootlevel' => [
            'type' => 'boolean',
        ],
        'CatalogName' => [
            'type' => 'string',
            'max' => 30,
        ],
        'Float' => [
            'type' => 'float',
        ],
        'ProductTitle' => [
            'type' => 'string',
            'min' => 3,
            'max' => 80,
        ],
        'ProductForeignId' => [
            'type' => 'string',
            'max' => 255,
        ],
        'ProductDescription' => [
            'type' => 'string',
        ],
        'ProductShortDescription' => [
            'type' => 'string',
            'max' => 2000
        ],
        'ProductPrice' => [
            'type' => 'float',
        ],
        'ProductEan' => [
            'type' => 'integer',
        ],
        'ProductUpc' => [
            'type' => 'integer',
        ],
        'ProductIsbn' => [
            'type' => 'string',
            'pattern' => '^(97(8|9))?\d{9}(\d|X)$', /* /\b(?:ISBN(?:: ?| ))?((?:97[89])?\d{9}[\dx])\b/i */
        ],
        'ProductStockAmount' => [
            'type' => 'integer',
        ],
        'ProductImageUrl' => [
            'type' => 'string',
            'max' => 255,
            'filters' => [
                [
                    'method' => '\GuzzleHttp\Url::fromString',
                    'args' => ['array', '@value'],
                ]
            ],
        ],
        'ProductImageType' => [
            'type' => 'integer',
            'min' => 1,
            'max' => 1,
        ],
        'ProductImageForeignId' => [
            'type' => 'string',
            'max' => 255,
        ],
    ]
];

