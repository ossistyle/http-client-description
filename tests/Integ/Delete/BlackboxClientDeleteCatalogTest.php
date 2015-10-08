<?php

namespace Vws\Test\Integ\Delete;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientDeleteCatalogTest extends WebApiClientAbstractTestCase
{
    use CatalogDataProvider;

    /**
     * @dataProvider catalogDeleteData
     */
    public function testDeleteCatalogValidation(
        $catalog,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->deleteValidation('deleteCatalogByForeignId', $catalog);
    }

    /**
     * @dataProvider catalogCreateDeleteData
     */
    public function testCreateDeleteCatalogValidation(
        $catalog,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse[0];
        $this->postValidation('postCatalog', $catalog[0]);
        $catalog[1]['ForeignId'] = $catalog[0]['ForeignId'];
        $this->expectedResponse = $expectedResponse[1];
        $this->deleteValidation('deleteCatalogByForeignId', $catalog[1]);
    }
}
