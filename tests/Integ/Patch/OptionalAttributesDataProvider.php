<?php

namespace Vws\Test\Integ\Patch;

trait OptionalAttributesDataProvider
{
    public static function optionalAttributesData()
    {
        return array_merge(
            self::emptyOptionalAttributesForeignId(),
            self::missingOptionalAttributesForeignId(),
            self::invalidOptionalAttributesForeignId(),
            // too long
            // self::tooLongOptionalAttributesForeignId(),
            self::tooLongOptionalAttributesName(),
            self::tooLongOptionalAttributesValue(),
            self::tooLongOptionalAttributesNameAndValue(),
            // Iteration 21
            self::duplicateOptionalAttributesName()
        );
    }

    public static function emptyOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => '',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty or missing.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function missingOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'Name' => '1 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 0004,
                            'Severity' => 2,
                            'Message' => 'ForeignId is empty or missing.',
                            'Description' => 'ForeignId is empty or missing. '
                                            .'It\'s required to enter an existing foreign Id.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function invalidOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => 'invalid_foreign_id',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 404,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],

        ];
    }

    public static function tooLongOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => self::randStrGen(61),
                    'Name' => '3 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7003,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.ForeignId is too long.',
                            'Description' => 'Product (.+): The \'ForeignId\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'Maximum length for \'ForeignId\' is 60 chars. '
                                            .'It is required to send a unique ForeignId.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function tooLongOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '3 OptionalAttributes ' . date('y-m-d H:i:s') . ' '
                            .' Name with more than 255 chars, '
                            . self::randStrGen(255),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7004,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Name is too long.',
                            'Description' => 'Product (.+): The \'Name\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'The \'Name\' has been truncated by 255 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function tooLongOptionalAttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '3 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s') .' '
                                . self::randStrGen(4000),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7005,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Value is too long.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'The \'Value\' has been truncated by 4000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function tooLongOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '3 OptionalAttributes ' . date('y-m-d H:i:s') .' '
                                . self::randStrGen(255),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s') .' '
                                . self::randStrGen(4000),
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 200,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7004,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Name is too long.',
                            'Description' => 'Product (.+): The \'Name\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'The \'Name\' has been truncated by 255 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                        [
                            'Code' => 7005,
                            'Severity' => 1,
                            'Message' => 'OptionalProductAttributes.Value is too long.',
                            'Description' => 'Product (.+): The \'Value\' of the '
                                            .'OptionalProductAttributes with '
                                            .'(.+): (.+) is too long. '
                                            .'The \'Value\' has been truncated by 4000 chars.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],

        ];
    }

    public static function unknowsOptionalAttributesProperty()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '3 OptionalAttributes ' . date('y-m-d H:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                    'Foo' => 'Baz'
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                ],
            ],

        ];
    }

    public static function duplicateOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '2 OptionalAttributes',
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d H:i:s'),
                ],
                [
                    'Succeeded' => true,
                    'StatusCode' => 400,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 7008,
                            'Severity' => 2,
                            'Message' => 'OptionalProductAttributes.Name duplicity.',
                            'Description' => 'Product (.+): The \'Name\' of the OptionalProductAttributes '
                                            .'with ForeignId: (.+) alyready exists in database. '
                                            .'The \'Name\' of an OptionalProductAttributes should be unique.',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
