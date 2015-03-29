<?php

return [
    'metadata' => [
        'apiVersion' => '2015-03-27',
        'serviceFullName' => 'Via Blackbox Service',
        'timestampFormat' => 'iso8601',
        'protocol' => 'rest-json',
        'endpointPrefix' => 'blackbox',
        'jsonVersion' => '1.1',
    ],
    'operations' => [
        'GetCatalogs' => [
            'name' => 'GetCatalogs',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'Catalogs',
            ],
            'output' => [
              'shape' => 'GetCatalogsOutput',
            ],
        ],
        'DeleteCatalogById' => [
            'name' => 'DeleteCatalogById',
            'http' => [
              'method' => 'DELETE',
              'requestUri' => 'Catalogs/{Id}',
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
              'requestUri' => 'Catalogs/{Id}',
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
              'requestUri' => 'Catalogs',
            ],
            'input' => [
              'shape' => 'PostCatalogInput',
            ],
            'output' => [
              'shape' => 'PostCatalogOutput',
            ],

        ],
        'PostCatalogs' => [
            'name' => 'PostCatalogs',
            'http' => [
              'method' => 'POST',
              'requestUri' => 'Catalogs/PostList',
            ],
            'input' => [
              'shape' => 'PostCatalogsInput',
            ],
            'output' => [
              'shape' => 'PostCatalogsOutput',
            ],

        ],
        'GetProductById' => [
            'name' => 'GetProductById',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'Products/{Id}',
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
              'requestUri' => 'Products',
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
              'requestUri' => 'Products',
            ],
            'input' => [
              'shape' => 'PostProductInput',
            ],
            'output' => [
              'shape' => 'PostProductOutput',
            ],

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
            ],
        ],
        'GetSalesOrdersById' => [
            'name' => 'GetSalesOrdersById',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'SalesOrders/{Id}',
            ],
            'input' => [
              'shape' => 'GetSalesOrdersByIdInput',
            ],
            'output' => [
              'shape' => 'GetSalesOrdersByIdOutput',
            ],
        ],
        'GetNewSalesOrders' => [
            'name' => 'GetNewSalesOrders',
            'http' => [
              'method' => 'GET',
              'requestUri' => 'SalesOrders',
            ],
            'input' => [
              'shape' => 'GetNewSalesOrdersInput',
            ],
            'output' => [
              'shape' => 'GetNewSalesOrdersOutput',
            ],
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
                     'location' => 'uri',
                     'locationName' => 'Id',
                 ],
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
                    'location' => 'uri',
                    'locationName' => 'Id',
                ],
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
            ],
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
            ],
        ],

        'CatalogList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'Catalog',
            ],
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
                     'shape' => 'Paging',
                 ],
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
        ],

        'GetNewSalesOrdersInput' => [
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
        ],

        'GetNewSalesOrdersOutput' => [
             'type' => 'structure',
             'members' => [
                 'EntityList' =>  [
                   'shape' => 'SalesOrderList',
                 ],
                 'Messages' =>  [
                     'shape' => 'MessageList',
                 ],
                 'Pagination' => [
                     'shape' => 'Paging',
                 ],
             ],
        ],

        'ProductList' => [
             'type' => 'list',
             'member' => [
                 'shape' => 'Product',
             ],
        ],

        'Product' => [
            'type' => 'structure',
            'required' => [
                'Title',
                'ForeignId',
                'Price',
                'StockAmount',
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
                'Images' => [
                    'shape' => 'ProductImageList',
                ],
                'Specifics' => [
                    'shape' => 'ProductSpecificsList',
                ],
            ],
        ],

        'GetProductByIdInput' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri',
                    'locationName' => 'Id',
                ],
            ],
            'required' => [
              'Id',
            ],
        ],

        'GetProductByIdOutput' => [
            'type' => 'structure',
            'members' => [
                'EntityList' =>  [
                  'shape' => 'ProductList',
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
                'StockAmount',
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
                'Images' => [
                    'shape' => 'ProductImageList',
                ],
                'Specifics' => [
                    'shape' => 'ProductSpecificsList',
                ],
            ],
        ],

        'ProductImageList' => [
            'type' => 'list',
            'maxItems' => 1,
            'minItems' => 1,
            'member' => [
                'shape' => 'ProductImage',
            ],
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
            ],
        ],

        'ProductSpecificsList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'ProductSpecific',
            ],
        ],

        'ProductSpecific' => [
            'type' => 'structure',
            'required' => [
                'Name',
                'Value',
            ],
            'members' => [
                'Name' => [
                    'shape' => 'StringMax255',
                ],
                'Value' => [
                    'shape' => 'StringMax255',
                ],
            ],
        ],

        /**************************************
         *      PRODUCTS END SALESORDERS BEGIN
         **************************************/
        'GetSalesOrdersByIdInput' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'uri',
                    'locationName' => 'Id',
                ],
            ],
            'required' => [
              'Id',
            ],
        ],

        'GetSalesOrdersByIdOutput' => [
            'type' => 'structure',
            'members' => [
                'EntityList' =>  [
                  'shape' => 'SalesOrderList',
                ],
                'Messages' =>  [
                    'shape' => 'MessageList',
                ],
            ],
        ],

        'SalesOrderList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'SalesOrder',
            ],
        ],

        'SalesOrder' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'Buyer' => [
                    'shape' => 'BuyerType'
                ],
                'SalesOrderItems' => [
                    'shape' => 'SalesOrderItemList'
                ],
                'CreationDate' => [
                    'shape' => 'TimestampType',
                ],
                'TotalPrice' => [
                    'shape' => 'Float',
                ],
                'CurrencyCode' => [
                    'shape' => 'StringMax5',
                ],
                'ItemCount' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'TotalAmount' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'PlatformName' => [
                    'shape' => 'StringMax50',
                ],
                'BuyerId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'AddressId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'ShippingAddressId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'CheckoutStatus' => [
                    'shape' => 'IntegerMin0Max1',
                ],
                'CheckoutCompletionDate' => [
                    'shape' => 'TimestampType',
                ],
                'PaymentStatus' => [
                    'shape' => 'StringMax50',
                ],
                'PaymentOption' => [
                    'shape' => 'StringMax50',
                ],
                'ShippingService' => [
                    'shape' => 'StringMax255',
                ],
                'BuyerCheckoutMessage' => [
                    'shape' => 'StringNoMinMax',
                ],
                'ShippingStatus' => [
                    'shape' => 'IntegerMin0Max2',
                ],
                'ShippingServiceCost' => [
                    'shape' => 'Float',
                ],
                'PaymentTransactionId' => [
                    'shape' => 'StringMax255',
                ],
                'MarkedAsPayed' => [
                    'shape' => 'Boolean',
                ],
                'MarkedAsShipped' => [
                    'shape' => 'Boolean',
                ],
                'ForeignOrderId' => [
                    'shape' => 'StringMax50',
                ],
                'PaidAmount' => [
                    'shape' => 'Float',
                ],
                'PaidDate' => [
                    'shape' => 'TimestampType',
                ],
                'ModificationDate' => [
                    'shape' => 'TimestampType',
                ],
                'PlatformOrderId' => [
                    'shape' => 'StringMax255',
                ],
                'EbayModificationDate' => [
                    'shape' => 'TimestampType',
                ],
                'BuyerPackageEnclosure' => [
                    'shape' => 'StringMax4000',
                ],
                'Address' => [
                    'shape' => 'AddressType',
                ],
                'ShippingAddress' => [
                    'shape' => 'AddressType',
                ],
            ],
        ],

        'AddressType' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'Type' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'Name' => [
                    'shape' => 'StringMax255',
                ],
                'Surname' => [
                    'shape' => 'StringMax255',
                ],
                'Street' => [
                    'shape' => 'StringMax255',
                ],
                'Addition' => [
                    'shape' => 'StringMax255',
                ],
                'PostalCode' => [
                    'shape' => 'StringMax50',
                ],
                'Town' => [
                    'shape' => 'StringMax255',
                ],
                'Country' => [
                    'shape' => 'StringMax255',
                ],
                'State' => [
                    'shape' => 'StringMax255',
                ],
                'Salutation' => [
                    'shape' => 'StringMax255',
                ],
                'Phone' => [
                    'shape' => 'StringMax255',
                ],
                'Email' => [
                    'shape' => 'StringMax255',
                ],
            ],
        ],

        'BuyerType' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'BuyerName' => [
                    'shape' => 'StringMax255',
                ],
            ],
        ],

        'SalesOrderItemList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'SalesOrderItem',
            ],
        ],

        'SalesOrderItem' => [
            'type' => 'structure',
            'members' => [
                'Id' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'SalesOrderId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'CreationDate' => [
                    'shape' => 'TimestampType',
                ],
                'Amount' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'Price' => [
                    'shape' => 'Float',
                ],
                'CurrencyCode' => [
                    'shape' => 'StringMax5',
                ],
                'Name' => [
                    'shape' => 'StringMax255',
                ],
                'PlatformName' => [
                    'shape' => 'StringMax50',
                ],
                'ShippingStatus' => [
                    'shape' => 'IntegerMin0Max1',
                ],
                'TrackingNumbers' => [
                    'shape' => 'StringMax255',
                ],
                'CarrierUsed' => [
                    'shape' => 'StringMax255',
                ],
                'ProductId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'ForeignId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'TransactionId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'PlatformItemId' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'ShippingDate' => [
                    'shape' => 'TimestampType',
                ],
                'FeedbackStatus' => [
                    'shape' => 'IntegerNoMinMax',
                ],
                'ModificationDate' => [
                    'shape' => 'TimestampType',
                ],
                'PlatformOrderId' => [
                    'shape' => 'StringMax255',
                ],
                'SalesDate' => [
                    'shape' => 'TimestampType',
                ],
            ],
        ],

        /**********************************************
         *      MessageList BEGIN
         *********************************************/

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
                'Description' => [
                    'shape' => 'StringMax2000',
                ],
            ],
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
            ],
        ],

        'ReviseInventoryInput' => [
            'type' => 'structure',
            'members' => [
                'productId' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'querystring',
                    'locationName' => 'productId',
                ],
                'price' => [
                    'shape' => 'Float',
                    'location' => 'querystring',
                    'locationName' => 'price',
                ],
                'stockAmount' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'querystring',
                    'locationName' => 'stockAmount',
                ],
                'productVariationId' => [
                    'shape' => 'IntegerNoMinMax',
                    'location' => 'querystring',
                    'locationName' => 'productVariationId',
                ],
                'discountOfferPrice' => [
                    'shape' => 'Float',
                    'location' => 'querystring',
                    'locationName' => 'discountOfferPrice',
                ],
            ],
            'required' => [
                'productId',
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
        'IntegerMin0Max1' => [
            'type' => 'integer',
            'min' => 0,
            'max' => 1,
        ],
        'IntegerMin0Max2' => [
            'type' => 'integer',
            'min' => 0,
            'max' => 2,
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
            'default' => 50,
        ],
        'IntegerMin1NoMaxDefault1' => [
            'type' => 'integer',
            'min' => 1,
            'default' => 1,
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
        'StringMax5' => [
            'type' => 'string',
            'min' => 1,
            'max' => 5,
        ],
        'StringMax50' => [
            'type' => 'string',
            'min' => 1,
            'max' => 50,
        ],
        'StringMax2000' => [
            'type' => 'string',
            'max' => 2000,
        ],
        'StringMax255' => [
            'type' => 'string',
            'max' => 255,
        ],
        'StringMax4000' => [
            'type' => 'string',
            'max' => 4000,
        ],
        'TimestampType' => [
            'type' => 'timestamp',
        ],
        'Url' => [
            'type' => 'string',
            'max' => 255,
            'pattern' => '#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#',
            'filters' => [
                [
                    'method' => 'Respect\Validation\Validator::url',
                    'args' => [true, '@value'],
                ],
            ],
        ],
    ],
];
