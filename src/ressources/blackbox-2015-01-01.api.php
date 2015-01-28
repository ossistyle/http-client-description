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

        ]
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
        'CatalogList' => [
            'type' => 'list',
            'member' => [
                'shape' => 'Catalog'
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
    ]
];

