<?php

namespace Vws\Test\Integ;

use Vws\Exception\VwsException;
use GuzzleHttp\Event\BeforeEvent;

/**
 *
 */
class BlackboxClientCatalogSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetCatalogsEnsureBodyContainsCorrectIdsAndHasEmptyMessages()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogs();

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

        $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     *
     */
    public function testGetCatalogById117702EnsureBodyContainsGivenIdAndHasEmptyMessages()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 117702]);

        $this->assertSame(
            117702,
            $response->search('EntityList[0].Id'),
            'EntityList[0].Id is not equal to 117702'
        );
        $this->assertEmpty($response->search('Messages'), 'Messages is not empty');
    }

    /**
     *
     *
     */
    public function testGetCatalogById4711EnsureBodyContainsCorrectMessageAndHasEmptyEntityList()
    {
        $options = [];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->getCatalogById(['Id' => 4711]);

        // error message exists
        $this->assertSame(
            '3000',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 3000'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Error (2)'
        );
        $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
    }

    /**
     * { "Code": "3103", "Severity": 2, "Message": "Name is empty." }
     */
    public function testPostCatalogEmptyNameEnsureBodyContainsCorrectMessageAndCode3103AndSeverity()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => '',
                'IsRootLevel' => true,
                'ForeignId' => 'root_1'
            ]
        );

        // error message code exists
        $this->assertSame(
            '3103',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 3103'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not a Error (2)'
        );
        $this->assertSame(
            '"Name" is empty.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '""Name" is empty."'
        );
    }

    /**
     * { "Code": "3102", "Severity": 1, "Message": "The value of the property "Name" is too long for eBay. We have cut the value short to 30 chars." }
     * @return array
     */
    public function testPostCatalogNameTooLongEnsureBodyContainsCorrectMessageAndCode3102AndSeverityWarning()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => 'Name_too_long_Name_too_long_Name_too_long',
                'IsRootLevel' => true,
                'ForeignId' => 'root_catalog'
            ]
        );

        // warning message code exist
        $this->assertSame(
            '3102',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 3102'
        );
        $this->assertSame(
            1,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Warning (1)'
        );
        $this->assertSame(
            'The value of the property "Name" is too long for eBay. We have cut the value short to 30 chars.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '"The value of the property "Name" is too long for eBay. We have cut the value short to 30 chars.""'
        );

        $toDeleteCatalogId = [];
        $toDeleteCatalogId[] = $response->search('EntityList[0].Id');

        return $toDeleteCatalogId;
    }

    /**
     * { "Code": "XXXX", "Severity": 2, "Message": "######" }
     * @return array
     */
    public function testPostCatalogNoForeignIdEnsureBodyContainsCorrectMessageAndCodeXXXXAndSeverityXXXX()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => 'Root Catalog',
                'IsRootLevel' => true,
                'ForeignId' => ''
            ]
        );

        // error message code exists
        $this->assertSame(
            'XXXX',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not XXXX'
        );
        $this->assertSame(
            'XXXX',
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not a XXXX (X)'
        );
        $this->assertSame(
            'XXXX',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains XXXX'
        );

        $toDeleteCatalogId = [];
        $toDeleteCatalogId[] = $response->search('EntityList[0].Id');

        return $toDeleteCatalogId;
    }

    /**
     * { "Code": "3105", "Severity": 1, "Message": "The value of the property "IsRootLevel" was changed to false." }
     * @return array
     */
    public function testPostCatalogChildCatalogHasIsRootLevelTrueEnsureBodyContainsCorrectMessageAndCode3105AndSeverityWarning()
    {
        $options = ['validate' => false];
        $client = $this->getSdk()->createClient('blackbox', $options);
        $response = $client->postCatalog(
            [
                'Name' => 'Root Catalog',
                'IsRootLevel' => true,
                'ForeignId' => 'root_catalog',
                'ChildCatalogs' => [
                    [
                        'Name' => 'Child Catalog 1.1',
                        'ForeignId' => 'child_1_1',
                        'IsRootLevel' => true,
                    ],
                ]
            ]
        );

        // warning message code exist
        $this->assertSame(
            '3105',
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 3105'
        );
        $this->assertSame(
            1,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Warning (1)'
        );
        $this->assertSame(
            'The value of the property "IsRootLevel" was changed to false.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '"The value of the property "IsRootLevel" was changed to false."'
        );

        $toDeleteCatalogId = [];
        $toDeleteCatalogId[] = $response->search('EntityList[0].Id');
        $toDeleteCatalogId[] = $response->search('EntityList[0].ChildCatalogs[0].Id');

        return $toDeleteCatalogId;
    }

    /**
     * @depends testPostCatalogNameTooLongEnsureBodyContainsCorrectMessageAndCode3102AndSeverityWarning
     * #depends testPostCatalogNoForeignIdEnsureResponseContainsCorrectMessageAndCodeXXXXAndSeverityXXXX
     * @depends testPostCatalogChildCatalogHasIsRootLevelTrueEnsureBodyContainsCorrectMessageAndCode3105AndSeverityWarning
     *
     */
    public function testDeleteCatalogByIdEnsureBodyIsEmptyAndCatalogIsDeleted()
    {
        $args = func_get_args();

        $options = [
            'validate' => false,
            //'debug' => true
        ];
        $client = $this->getSdk()->createClient('blackbox', $options);

        foreach ($args as $values) {
            foreach ($values as $value) {
                $client->deleteCatalogById(['Id' => $value]);
                $getResponse = $client->getCatalogById(['Id' => $value]);

                $this->assertSame(
                    '3000',
                    $getResponse->search('Messages[0].Code'),
                    'Messages[0].Code is not 3000'
                );
                $this->assertSame(
                    2,
                    $getResponse->search('Messages[0].Severity'),
                    'Messages[0].Severity is not Error (2)'
                );
                $this->assertEmpty($getResponse->search('EntityList'), 'EntityList is not empty');
            }
        }
    }
}
