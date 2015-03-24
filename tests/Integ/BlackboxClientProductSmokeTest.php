<?php

namespace Vws\Test\Integ;


/**
 *
 */
class BlackboxClientProductSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetProductById1599237EnsureBodyContainsGivenIdAndHasEmptyMessages()
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
    public function testGetProductsWithoutQueryParamsEnsureBodyContainsCorrectResult()
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
    public function testGetProductsEntriesPerPage10PageNumber10EnsureBodyContainsCorrectResult()
    {
        $args = [
            'region'  => 'sandbox',
            'profile' => 'integ-sandbox',
            'version' => 'latest',
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
