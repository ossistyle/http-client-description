<?php

namespace Vws\Test\Integ\WebApi\Post;

use Vws\Test\Integ\WebApi\ClientAbstractTestCase;

/**
 *
 */
class ClientPostCatalogTest extends ClientAbstractTestCase
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
