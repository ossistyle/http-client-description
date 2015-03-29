<?php

namespace Vws\Test\Integ;

trait CatalogDataProvider
{
    public function catalogData()
    {
        return array_merge(
            $this->emptyName(),
            $this->missingName()
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
}
