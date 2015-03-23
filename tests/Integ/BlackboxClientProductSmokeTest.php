<?php

namespace Vws\Test\Integ;

use Vws\Sdk;
use GuzzleHttp\Command\Event\PreparedEvent;

/**
 *
 */
class BlackboxClientProductSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetProductById1599237EnsureBodyContainsGivenIdAndHasEmptyMessages ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);
        $response = $client->getProductById(['Id' => 1599237]);

        $this->assertSame(
            1599237,
            $response->search('EntityList[0].Id'),
            'EntityList[0].Id is not equal to 1599237'
        );
        $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     */
    public function testGetProductsEnsureBodyContainsCorrectIdsAndHasEmptyMessages ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);
        $response = $client->getProducts(['limit' => 10, 'page' => 1]);

        $this->assertSame(
            117697,
            $response->search('EntityList[0].Id'),
            'EntityList[0].Id is not equal to 117697'
        );
        $this->assertSame(
            117702,
            $response->search('EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id'),
            'EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id is not equal to 117702'
        );
    }
}
