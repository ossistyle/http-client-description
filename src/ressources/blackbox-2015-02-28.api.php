<?php

return [
    'metadata' => [
        'apiVersion' => '2015-02-28',
        'serviceFullName' => 'Via Blackbox Service',
        'timestampFormat' => 'rfc822',
        'protocol' => 'rest-json',
        'endpointPrefix' => 'blackbox',
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
        'DeleteCatalogById' => [
            'name' => 'DeleteCatalogById',
            'http' => [
              'method' => 'DELETE',
              'requestUri' => 'api/Catalogs/{Id}',
            ],
            'input' => [
              'shape' => 'DeleteCatalogByIdInput',
            ],
            'output' => [
              'shape' => 'GetCatalogByIdOutput',
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
        'GetProductById' => [
            'name' => 'GetProductById',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'api/Products/{Id}',
            ],
            'input' => [
              'shape' => 'GetProductByIdInput',
            ],
            'output' => [
              'shape' => 'GetProductByIdOutput',
            ],
        ],
        'GetProducts' => [
            'name' => 'GetProducts',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'api/Products',
            ],
            'input' => [
              'shape' => 'GetProductsInput',
            ],
            'output' => [
              'shape' => 'GetProductsOutput',
            ],
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
        'ReviseInventory' => [
            'name' => 'ReviseInventory',
            'http' => [
              'method' => 'POST',
              'requestUri' => 'ReviseInventoryStatus?productId={productId}L&price={price}m&stockAmount={stockAmount}&productVariationId={productVariationId}L&{discountOfferPrice}m',
            ],
            'input' => [
              'shape' => 'ReviseInventoryInput',
            ],
            'output' => [
              'shape' => 'ReviseInventoryOutput',
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

         'DeleteCatalogByIdInput' => [
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
                'EntityList' =>  [
                  'shape' => 'CatalogList',
                ],
                'Messages' =>  [
                    'shape' => 'MessageList',
                ],
            ],
        ],

        'GetCatalogsOutput' => [
            'type' => 'structure',
            'members' => [
                'EntityList' =>  [
                  'shape' => 'CatalogList',
                ],
                'Messages' =>  [
                    'shape' => 'MessageList',
                ],
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
                'EntityList' =>  [
                  'shape' => 'CatalogList',
                ],
                'Messages' =>  [
                    'shape' => 'MessageList',
                ],
            ],
        ],

        'PostCatalogsInput' => [
            'type' => 'list',
            'member' => [
                'shape' => 'PostCatalogInput',
            ],
        ],

        'PostCatalogsOutput' => [
          'type' => 'structure',
          'members' => [
              'EntityList' =>  [
                'shape' => 'CatalogList',
              ],
              'Messages' =>  [
                  'shape' => 'MessageList',
              ],
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

         'GetProductsOutput' => [
             'type' => 'structure',
             'members' => [
                 'EntityList' =>  [
                   'shape' => 'ProductList',
                 ],
                 'Messages' =>  [
                     'shape' => 'MessageList',
                 ],
                 'Pagination' => [
                     'shape' => 'Paging'
                 ]
             ],
         ],

        'GetProductsInput' => [
            'type' => 'structure',
            'members' => [
                'limit' => [
                  'shape' => 'IntegerMin1Max100Default100',
                  'location' => 'querystring',
                  'locationName' => 'EntriesPerPage',
                ],
                'page' => [
                  'shape' => 'IntegerMin1NoMaxDefault1',
                  'location' => 'querystring',
                  'locationName' => 'PageNumber',
                ],
            ],
            'required' => [
                'limit',
                'page',
            ],
        ],


         'ProductList' => [
             'type' => 'list',
             'member' => [
                 'shape' => 'Product'
             ]
        ],

        'Product' => [
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

        'GetProductByIdInput' => [
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

        'GetProductByIdOutput' => [
            'type' => 'structure',
            'members' => [
                'EntityList' =>  [
                  'shape' => 'CatalogList',
                ],
                'Messages' =>  [
                    'shape' => 'MessageList',
                ],
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

        'MessageList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'Message',
            ],
        ],

        'Message' => [
            'type' => 'structure',
            'members' => [
                'Code' => [
                    'shape' => 'StringMax255',
                ],
                'Severity' => [
                    'shape' => 'StringMax255',
                ],
                'Message' => [
                    'shape' => 'StringMax2000',
                ],
            ]
        ],

        'Paging' => [
            'type' => 'structure',
            'members' => [
                'EntriesPerPage' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'PageNumber' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'TotalNumberOfPages' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'TotalNumberOfEntries' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'HasPreviousPage' => [
                    'shape' => 'Boolean',
                ],
                'HasNextPage' => [
                    'shape' => 'Boolean',
                ],
            ]
        ],

        'ReviseInventoryInput' => [
            'type' => 'structure',
            'members' => [
                'productId' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri'
                ],
                'price' => [
                    'shape' => 'Float',
                    'location' => 'uri'
                ],
                'stockAmount' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri'
                ],
                'productVariationId' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri'
                ],
                'discountOfferPrice' => [
                    'shape' => 'Float',
                    'location' => 'uri'
                ],
            ],
            'productId' => [
                'Id',
            ],
        ],

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
        'IntegerMin1Max100Default100' => [
            'type' => 'integer',
            'min' => 1,
            'max' => 100,
            'default' => 50
        ],
        'IntegerMin1NoMaxDefault1' => [
            'type' => 'integer',
            'min' => 1,
            'default' => 1
        ],
        'IntegerMax999' => [
            'type' => 'integer',
            'min' => 0,
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
