<?php

namespace Vws\Test\Integ\Patch;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientPatchProductTest extends BlackboxClientAbstractTestCase
{
    use OptionalAttributesDataProvider;

    /**
     * @dataProvider optionalAttributesData
     */
    public function testPatchOptionalAttributesValidation(
        $request,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;

        $data = [
            'ForeignId' => isset($request['ForeignId']) ? $request['ForeignId'] : '',
            'Name' => $request['Name'],
            'Value' => $request['Value'],
        ];
        if (isset($request['Foo'])) {
            $data['Foo'] = $data['Foo'];
        }

        $this->patchValidation(
            'patchOptionalAttributes',
            $data
        );
    }
}
