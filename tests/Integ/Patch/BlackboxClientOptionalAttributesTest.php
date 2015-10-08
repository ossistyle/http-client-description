<?php

namespace Vws\Test\Integ\Patch;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientOptionalAttributesTest extends WebApiClientAbstractTestCase
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
            'Name' => isset($request['Name']) ? $request['Name'] : '',
            'Value' => isset($request['Value']) ? $request['Value'] : '',
        ];
        if (isset($request['Foo'])) {
            $data['Foo'] = $request['Foo'];
        }

        $this->patchValidation(
            'patchOptionalAttributes',
            $data
        );
    }
}
