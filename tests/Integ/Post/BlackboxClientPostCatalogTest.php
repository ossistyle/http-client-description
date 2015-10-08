<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\WebApiClientAbstractTestCase;

/**
 *
 */
class WebApiClientPostCatalogTest extends WebApiClientAbstractTestCase
{
    use CatalogDataProvider;

    /**
     * @dataProvider catalogData
     */
    public function testPostCatalogValidation(
        $catalog,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->postValidation('postCatalog', $catalog);
    }
}
