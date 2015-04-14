<?php

namespace Vws\Test\Integ;

trait PatchOptionalAttributesDataProvider
{
    public static function patchOptionalAttributesData()
    {
        return array_merge(
            self::patchEmptyOptionalAttributesForeignId(),
            self::patchMissingOptionalAttributesForeignId(),
            self::patchInvalidOptionalAttributesForeignId(),
            // too long
            self::patchTooLongOptionalAttributesName(),
            self::patchTooLongOptionalAttributesValue(),
            self::patchTooLongOptionalAttributesNameAndValue()
        );
    }

    public static function patchEmptyOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => '',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s'),
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

    public static function patchMissingOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s'),
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

    public static function patchInvalidOptionalAttributesForeignId()
    {
        return
        [
            [
                [
                    'ForeignId' => 'invalid_foreign_id',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s'),
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

    public static function patchTooLongOptionalAttributesName()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s') . ''
                            .' Name with more than 255 chars, '
                            . self::randStrGen(255),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s'),
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

    public static function patchTooLongOptionalAttributesValue()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s') .''
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

    public static function patchTooLongOptionalAttributesNameAndValue()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s') .''
                                . self::randStrGen(255),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s') .''
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

    public static function patchUnknowsOptionalAttributesProperty()
    {
        return
        [
            [
                [
                    'ForeignId' => '3_optional_attribute',
                    'Name' => '1 OptionalAttributes ' . date('y-m-d h:i:s'),
                    'Value' => 'Lorem ipsum dolor sit amet - ' . date('y-m-d h:i:s'),
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
}
