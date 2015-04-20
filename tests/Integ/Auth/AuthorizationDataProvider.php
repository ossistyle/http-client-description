<?php

namespace Vws\Test\Integ\Auth;

trait AuthorizationDataProvider
{
    public static function authorizationData()
    {
        return array_merge(
            self::invalidUserName(),
            self::emptyUsername(),
            self::missingUsername(),
            self::invalidPassword(),
            self::emptyPassword(),
            self::missingPassword(),
            self::invalidSubscriptionToken(),
            self::emptySubscriptionToken(),
            self::missingSubscriptionToken(),
            self::emptyVendor(),
            self::missingVendor(),
            self::emptyVersion(),
            self::missingVersion()
        );
    }

    private static function invalidUsername()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function emptyUsername()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function missingUsername()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function invalidPassword()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function emptyPassword()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function missingPassword()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1000,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Username" or '
                                        .'"Password" is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function invalidSubscriptionToken()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1001,
                            'Severity' => 2,
                            'Message' => 'The header parameter "SubscriptionToken" '
                                        .'is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function emptySubscriptionToken()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1001,
                            'Severity' => 2,
                            'Message' => 'The header parameter "SubscriptionToken" '
                                        .'is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function missingSubscriptionToken()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1001,
                            'Severity' => 2,
                            'Message' => 'The header parameter "SubscriptionToken" '
                                        .'is not valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function emptyVendor()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1002,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Vendor" is not '
                                        .'valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function missingVendor()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1002,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Vendor" is not '
                                        .'valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function emptyVersion()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1003,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Version" is not '
                                        .'valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }

    private static function missingVersion()
    {
        return
        [
            [
                [
                    __FUNCTION__
                ],
                [
                    'Succeeded' => false,
                    'StatusCode' => 401,
                    'FunctionName' => __FUNCTION__,
                    'EntityListCount' => 0,
                    'Messages' => [
                        [
                            'Code' => 1003,
                            'Severity' => 2,
                            'Message' => 'The header parameter "Version" is not '
                                        .'valid or empty.',
                            'Description' => '',
                            'UserHelpLink' => '',
                            'DeveloperHelpLink' => '',
                        ],
                    ],
                ]
            ]
        ];
    }
}
