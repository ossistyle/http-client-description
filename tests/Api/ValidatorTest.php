<?php

namespace Vws\Test\Api;

use Vws\Api\Shape;
use Vws\Api\ShapeMap;
use Vws\Api\Validator;
use GuzzleHttp\Stream\Stream;

/**
 * @covers Vws\Api\Validator
 */
class ValidatorTest extends \PHPUnit_Framework_TestCase {

    public function validationProvider() {
        return [
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'string']]
                ],
                [],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'required' => ['foo'],
                    'members' => ['foo' => ['type' => 'string']]
                ],
                [],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] is missing and is a required parameter"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'string']]
                ],
                ['foo' => [1]],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be a string or an object that implements __toString(). Found array(1)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'string']]
                ],
                ['foo' => false],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be a string or an object that implements __toString(). Found bool(false)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'string', 'min' => 1]]
                ],
                ['foo' => ''],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be at least 1 characters long. Value provided is 0 characters long."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'string', 'max' => 1]]
                ],
                ['foo' => 'baz'],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be no more than 1 characters long. Value provided is 3 characters long."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer', 'pattern' => '#\\b[\\d\\-]{3,18}\\b#']]
                ],
                ['foo' => 12],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must match the following regular expression: #\\b[\\d\\-]{3,18}\\b#"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'boolean']]
                ],
                ['foo' => false],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'boolean']]
                ],
                ['foo' => true],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'boolean']]
                ],
                ['foo' => 1],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be a boolean. Found int(1)"
            ],
            // must be lax when validating numbers
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer']]
                ],
                ['foo' => '1'],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer']]
                ],
                ['foo' => 1],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer', 'max' => 1]]
                ],
                ['foo' => 2],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be no more than 1. Value provided is 2."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer', 'min' => 2]]
                ],
                ['foo' => 1],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be at least 2. Value provided is 1."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'integer']]
                ],
                ['foo' => 'abc'],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be numeric. Found string(3) \"abc\""
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'float']]
                ],
                ['foo' => 1.2],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'long']]
                ],
                ['foo' => 1000],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'character']]
                ],
                ['foo' => 'a'],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'character']]
                ],
                ['foo' => 1],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'structure']]
                ],
                ['foo' => false],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an associative array. Found bool(false)"
            ],
            // Ensures the array is associative
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'structure']]
                ],
                ['foo' => [1, 3]],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an associative array. Found array(2)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'member' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => [1, 3]],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'min' => 1,
                            'max' => 3,
                            'member' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => [1, 3]],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'min' => 1,
                            'max' => 3,
                            'member' => ['type' => 'integer']
                        ]
                    ]
                ],
                ['foo' => []],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must have at least 1 members. Value provided has 0."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'min' => 1,
                            'max' => 3,
                            'member' => ['type' => 'integer']
                        ]
                    ]
                ],
                ['foo' => [1, 2, 3, 4]],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must have no more than 3 members. Value provided has 4."
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'member' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => ['a' => 'b']],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'list',
                            'member' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => 'abc'],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an array. Found string(3) \"abc\""
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'map',
                            'key' => ['type' => 'string'],
                            'value' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => 'abc'],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an associative array. Found string(3) \"abc\""
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'map',
                            'key' => ['type' => 'string'],
                            'value' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => ['abc']],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an associative array. Found array(1)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'map',
                            'key' => ['type' => 'string'],
                            'value' => ['type' => 'string']
                        ]
                    ]
                ],
                ['foo' => ['abc' => '123']],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'map',
                            'key' => ['type' => 'string'],
                            'value' => [
                                'type' => 'structure',
                                'required' => 'foo',
                                'members' => [
                                    'foo' => ['type' => 'string']
                                ]
                            ]
                        ]
                    ]
                ],
                ['foo' => ['abc' => '123']],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo][abc] must be an associative array. Found string(3) \"123\""
            ],
            [
                [
                    'type' => 'structure',
                    'members' => [
                        'foo' => [
                            'type' => 'map',
                            'key' => ['type' => 'string'],
                            'value' => [
                                'type' => 'structure',
                                'required' => ['foo'],
                                'members' => [
                                    'foo' => ['type' => 'string']
                                ]
                            ]
                        ]
                    ]
                ],
                ['foo' => ['abc' => []]],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo][abc][foo] is missing and is a required parameter"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'blob']]
                ],
                ['foo' => []],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an fopen resource, a GuzzleHttp\\Stream\\StreamInterface object, or something that can be cast to a string. Found array(0)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'blob']]
                ],
                ['foo' => true],
                "Found 1 error while validating the input provided for the Foo operation:\n[foo] must be an fopen resource, a GuzzleHttp\\Stream\\StreamInterface object, or something that can be cast to a string. Found bool(true)"
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'blob']]
                ],
                ['foo' => fopen(__FILE__, 'r')],
                true
            ],
            [
                [
                    'type' => 'structure',
                    'members' => ['foo' => ['type' => 'blob']]
                ],
                ['foo' => Stream::factory('test')],
                true
            ],
        ];
    }

    /**
     * @dataProvider validationProvider
     */
    public function testValidatesInput($shape, $input, $result) {
        $shape = Shape::create($shape, new ShapeMap([]));
        $validator = new Validator();

        try {
            call_user_func($validator, 'Foo', $shape, $input);
            if ($result !== true) {
                $this->fail('Should have failed with ' . $result);
            }
        } catch (\InvalidArgumentException $e) {
            if ($result === true) {
                throw $e;
            } else {
                $this->assertEquals($result, $e->getMessage());
            }
        }
    }

}
