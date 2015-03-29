<?php

namespace Vws\Test\Integ;

trait CatalogDataProvider
{
    public function catalogData()
    {
        return array_merge(
            $this->emptyName(),
            $this->missingName(),
            $this->greaterThanThirtyCharsName(),
            $this->emptyForeignId(),
            $this->missingForeignId(),
            $this->childCatalogHasRootLevelTrue()
        );
    }

    public function emptyName()
    {
        return
        [
            [

                [
                    'Name' => '',
                    'IsRootLevel' => true,
                    'ForeignId' => $this->getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty Name: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3103,
                            'Severity' => 2,
                            'Message' => '"Name" is empty.',
                            'Description' => 'The value of the property "Name" cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function missingName()
    {
        return
        [
            [

                [
                    'IsRootLevel' => true,
                    'ForeignId' => $this->getGUID(),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing Name: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3103,
                            'Severity' => 2,
                            'Message' => '"Name" is empty.',
                            'Description' => 'The value of the property "Name" cannot be empty.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function greaterThanThirtyCharsName()
    {
        return
        [
            [

                [
                    'Name' => 'This Catalogname is greater than thirty chars',
                    'IsRootLevel' => true,
                    'ForeignId' => $this->getGUID(),
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 1,
                    'ReturnMessage' => 'Greater than 30 chars Name: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3102,
                            'Severity' => 1,
                            'Message' => 'The value of the property "Name" is too long.',
                            'Description' => 'The value of the property "Name" cannot not be longer than 30 chars because in your eBay shop you can only use 30 chars for the name of the catalog.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function emptyForeignId()
    {
        return
        [
            [

                [
                    'Name' => 'Root with empty ForeignId',
                    'IsRootLevel' => true,
                    'ForeignId' => '',
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Empty ForeignId: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3102,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with the ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
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
                    'Name' => 'Root with missing ForeignId',
                    'IsRootLevel' => true,
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'EntityListCount' => 0,
                    'ReturnMessage' => 'Missing ForeignId: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3102,
                            'Severity' => 1,
                            'Message' => 'ForeignId is empty.',
                            'Description' => 'The ForeignId of the catalog with with the ForeignId: <EMPTY> is empty. It is recommended to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function childCatalogHasRootLevelTrue()
    {
        return
        [
            [

                [
                    'Name' => 'Root with empty ForeignId',
                    'IsRootLevel' => true,
                    'ForeignId' => '',
                    'ChildCatalogs' => [
                        [
                            'Name' => 'Child Catalog 1.1',
                            'ForeignId' => 'child_1_1',
                            'IsRootLevel' => true,
                        ],
                    ],
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 201,
                    'EntityListCount' => 1,
                    'ReturnMessage' => 'Empty Name: Response contains not correct ',
                    'Messages' => [
                        [
                            'Code' => 3105,
                            'Severity' => 1,
                            'Message' => 'The value of the property "IsRootLevel" was changed to false.',
                            'Description' => 'One or more requested childCatalog have the property "IsRootLevel" set to "true". We changed the value to false.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
