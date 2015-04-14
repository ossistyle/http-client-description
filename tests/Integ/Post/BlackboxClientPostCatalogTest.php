<?php

namespace Vws\Test\Integ\Post;

use Vws\Test\Integ\BlackboxClientAbstractTestCase;

/**
 *
 */
class BlackboxClientPostCatalogTest extends BlackboxClientAbstractTestCase
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
