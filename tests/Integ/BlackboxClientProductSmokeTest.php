<?php

namespace Vws\Test\Integ;

use Vws\Sdk;

/**
 *
 */
class BlackboxClientProductSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetProductById4711EnsureBodyContainsGivenIdAndHasEmptyMessages ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);
        // $response = $client->getProductById(['Id' => 4711]);

        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'Get Product/4711: This test has not been implemented yet.'
        );

        // $this->assertSame(
        //     '4000',
        //     $response->search('Messages[0].Code'),
        //     'Messages[0].Code is not 4000'
        // );
        // $this->assertSame(
        //     2,
        //     $response->search('Messages[0].Severity'),
        //     'Messages[0].Severity is not Error (2)'
        // );
        // $this->assertSame(
        //     'The specified ProductId 4711 was not found.',
        //     $response->search('Messages[0].Message'),
        //     'Messages[0].Message does not contains '
        //     . 'The specified ProductId 4711 was not found.'
        // );
        // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
    }

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
        // $response = $client->getProductById(['Id' => 1599237]);

        $this->markTestIncomplete(
            'Get Product/1599237: This test has not been implemented yet.'
        );

        // $this->assertSame(
        //     1599237,
        //     $response->search('EntityList[0].Id'),
        //     'EntityList[0].Id is not equal to 1599237'
        // );
        // $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    public function testPostProductEnsureBodyContainsCorrectResult ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);

        $product = [
            'ForeignId' => $this->getGUID(),
            'Title' => 'Integration-Smoke-Test 1',
            'Description' => 'Beschreibung',
            'ShortDescription' => 'Kurzbeschreibung',
            'Price' => 1.23,
            'Ean' => '3492703010',
            'StockAmount' => 10,
            'ProductImages' => [
                'ForeignId' => $this->getGUID(),
                'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_1.jpg',
                'Type' => 1
            ],
        ];

        // $response = $client->postProduct($product);

        $this->markTestIncomplete(
            'Post Single Product: This test has not been implemented yet.'
        );
    }

    public function testPostProductListEnsureBodyContainsCorrectResult ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);

        $product = [
            [
                'ForeignId' => $this->getGUID(),
                'Title' => 'Integration-Smoke-Test 2',
                'Description' => 'Beschreibung',
                'ShortDescription' => 'Kurzbeschreibung',
                'Price' => 1.23,
                'Ean' => '3492703010',
                'StockAmount' => 10,
                'ProductImages' => [
                    'ForeignId' => $this->getGUID(),
                    'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
                    'Type' => 1
                ],
            ],
            [
                'ForeignId' => $this->getGUID(),
                'Title' => 'Integration-Smoke-Test 3',
                'Description' => 'Beschreibung',
                'ShortDescription' => 'Kurzbeschreibung',
                'Price' => 1.25,
                'Ean' => 'abc123',
                'StockAmount' => 7,
                'ProductImages' => [
                    'ForeignId' => $this->getGUID(),
                    'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
                    'Type' => 1
                ],
            ]
        ];

        // $response = $client->postProduct($product);

        $this->markTestIncomplete(
            'Post Single Product: This test has not been implemented yet.'
        );
    }

    /**
     *
     */
    public function testGetProductsWithoutQueryParamsEnsureBodyContainsCorrectResult ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
        ];
        $client = $this->getSdk()->createBlackbox($args);
        $paginator = $client->getPaginator('GetProducts');
        $paginator->next();

        $this->assertSame(
            'KS8803101',
            $paginator->current()->search('EntityList[0].ForeignId'),
            'EntityList[0].ForeignId is not equal to KS8803101'
        );
        $this->assertSame(
            'SO6002816',
            $paginator->current()->search('EntityList[23].ForeignId'),
            'EntityList[23].ForeignId is not equal to SO6002816'
        );
        $this->assertSame(
            'KK10C02701',
            $paginator->current()->search('EntityList[42].ForeignId'),
            'EntityList[42].ForeignId is not equal to KK10C02701'
        );
        $this->assertSame(
            'SJW237106',
            $paginator->current()->search('EntityList[99].ForeignId'),
            'EntityList[99].ForeignId is not equal to SJW237106'
        );
        $this->assertSame(
            100,
            $paginator->current()->search('Pagination.EntriesPerPage'),
            'Pagination.EntriesPerPage is not equal to 100 (default)'
        );
        $this->assertSame(
            1,
            $paginator->current()->search('Pagination.PageNumber'),
            'Pagination.PageNumber is not equal to 1 (default)'
        );
        $this->assertSame(
            false,
            $paginator->current()->search('Pagination.HasPreviousPage'),
            'Pagination.HasPreviousPage is not equal to false'
        );
        $this->assertSame(
            true,
            $paginator->current()->search('Pagination.HasNextPage'),
            'Pagination.HasNextPage is not equal to true'
        );
        $this->assertEmpty($paginator->current()->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     */
    public function testGetProductsEntriesPerPage10PageNumber10EnsureBodyContainsCorrectResult ()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest'
        ];
        $client = $this->getSdk()->createBlackbox($args);
        $paginator = $client->getPaginator('GetProducts', ['limit' => 10, 'page' => 10]);
        $paginator->next();

        $this->assertSame(
            'SHW233605',
            $paginator->current()->search('EntityList[0].ForeignId'),
            'EntityList[0].ForeignId is not equal to SHW233605'
        );
        $this->assertSame(
            'SJW237106',
            $paginator->current()->search('EntityList[9].ForeignId'),
            'EntityList[9].ForeignId is not equal to SJW237106'
        );
        $this->assertSame(
            10,
            $paginator->current()->search('Pagination.EntriesPerPage'),
            'Pagination.EntriesPerPage is not equal to given 10'
        );
        $this->assertSame(
            10,
            $paginator->current()->search('Pagination.PageNumber'),
            'Pagination.PageNumber is not equal to given 10'
        );
        $this->assertSame(
            true,
            $paginator->current()->search('Pagination.HasPreviousPage'),
            'Pagination.HasPreviousPage is not equal to true'
        );
        $this->assertSame(
            true,
            $paginator->current()->search('Pagination.HasNextPage'),
            'Pagination.HasNextPage is not equal to true'
        );
        $this->assertEmpty($paginator->current()->search('Messages'), 'Messages is not empty');
    }
}
