<?php

namespace Vws\Test\Integ;

use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 *
 */
class BlackboxClientProductSmokeTest extends BlackboxClientAbstractTestCase
{
    use PostProductDataProvider,
        PostProductVariationDataProvider,
        PatchOptionalAttributesDataProvider;

    /**
     * @dataProvider postProductData
     */
    public function testPostProductValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        $this->postValidation('postProduct', $product);
    }


    /**
     * @dataProvider postProductVariationData
     */
    public function testPostProductVariationValidation(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        //unset($product['StockAmount']);
        //unset($product['Price']);
        $product['StockAmount'] = 1;
        $product['Price'] = 1.23;
        $this->postValidation('postProduct', $product);
    }

    /**
     * @dataProvider patchOptionalAttributesData
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

    /**
     * #dataProvider productDataForExternalUser
     */
    public function postProductValidationForExternalUser(
        $product,
        $expectedResponse
    ) {
        $this->expectedResponse = $expectedResponse;
        unset($product['StockAmount']);
        unset($product['Price']);
        $this->postValidation('postProduct', $product);
    }

    // /**
    //  *
    //  */
    // public function testGetProductById4711EnsureBodyContainsGivenIdAndHasEmptyMessages ()
    // {
    //     $client = $this->createClient();
    //     // $response = $client->getProductById(['Id' => 4711]);
    //
    //     // Stop here and mark this test as incomplete.
    //     $this->markTestIncomplete(
    //         'Get Product/4711 (Wrong Id): This test has not been implemented yet.'
    //     );
    // }
    //
    // /**
    //  *
    //  */
    // public function testGetProductById1599237EnsureBodyContainsGivenIdAndHasEmptyMessages ()
    // {
    //     $client = $this->createClient();
    //     // $response = $client->getProductById(['Id' => 1599237]);
    //
    //     $this->markTestIncomplete(
    //         'Get Product/1599237 (Correct Id): This test has not been implemented yet.'
    //     );
    // }

//     /**
//      * @dataProvider productDataProvider
//      * @expectedException \Vws\Blackbox\Exception\BlackboxException
//      */
//     public function testPostProductValidationTitleError(
//         $product,
//         $exceptedMessagesCount,
//         $expectedEntityListCount
//     )
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Title'] = '';
//         $client = $this->createClient();
//         $response = $client->postProduct($tmpProduct);
//
//         $this->assertSame(
//             4000,
//             $response->search('Messages[0].Code'),
//             'Empty Title: ErrorCode is not equal to 4000'
//         );
//         $this->assertSame(
//             'Title cannot be empty.',
//             $response->search('Messages[0].Message'),
//             'Empty Title: ErrorMessage is doesn not contains'
//             . 'Title cannot be empty.'
//         );
//         $this->assertSame(
//             2,
//             $response->search('Messages[0].Severity'),
//             'Empty Title: ErrorSeverity is not Error (2)'
//         );
//         $this->assertEmpty(
//             $response->search('Messages[1]'),
//             'Empty Title: Messages contains more than one elements.'
//         );
//         $this->assertEmpty(
//             $response->search('EntityList'),
//             'Empty Title: EntityList is not empty'
//         );
//
//         // missing Title
//         $tmpProduct = $product;
//         unset($tmpProduct['Title']);
//         $client = $this->createClient();
//         $response = $client->postProduct($tmpProduct);
//
//         $this->assertSame(
//             4000,
//             $response->search('Messages[0].Code'),
//             'Missing Title: ErrorCode is not equal to 4000'
//         );
//         $this->assertSame(
//             'Title cannot be empty.',
//             $response->search('Messages[0].Message'),
//             'Missing Title: ErrorMessage is doesn not contains'
//             . 'Title cannot be empty.'
//         );
//         $this->assertSame(
//             2,
//             $response->search('Messages[0].Severity'),
//             'Missing Title: ErrorSeverity is not Error (2)'
//         );
//         $this->assertEmpty(
//             $response->search('Messages[1]'),
//             'Missing Title: Messages contains more than one elements.'
//         );
//         $this->assertEmpty(
//             $response->search('EntityList'),
//             'Missing Title: EntityList is not empty'
//         );
//
//         // $this->markTestIncomplete(
//         //     'Post Single Product (Validation Title): This test has not been implemented yet.'
//         // );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      * @expectedException \Vws\Blackbox\Exception\BlackboxException
//      */
//     public function testPostProductValidationTitleWarning(
//         $product,
//         $exceptedMessagesCount,
//         $expectedEntityListCount
//     )
//     {
//         // Title too long
//         $tmpProduct = $product;
//         $tmpProduct['Title'] = $this->randStrGen(81);
//         $client = $this->createClient();
//         $response = $client->postProduct($tmpProduct);
//
//         $this->assertSame(
//             4001,
//             $response->search('Messages[0].Code'),
//             'Title too long: ErrorCode is not equal to 4001'
//         );
//         $this->assertSame(
//             'Title is too long.',
//             $response->search('Messages[0].Message'),
//             'Title too long: ErrorMessage is doesn not contains'
//             . 'Title is too long.'
//         );
//         $this->assertSame(
//             1,
//             $response->search('Messages[0].Severity'),
//             'Title too long: ErrorSeverity is not Warning (1)'
//         );
//         $this->assertEmpty(
//             $response->search('Messages[1]'),
//             'Title too long: Messages contains more than one elements.'
//         );
//         $this->assertCount(
//             1,
//             $response->search('EntityList[0]'),
//             'Title too long: EntityList is empty - Product was not created'
//         );
//
//         // Title too short
//         $tmpProduct = $product;
//         $tmpProduct['Title'] = $this->randStrGen(2);
//         $client = $this->createClient();
//         $response = $client->postProduct($tmpProduct);
//
//         $this->assertSame(
//             4002,
//             $response->search('Messages[0].Code'),
//             'Title too short: ErrorCode is not equal to 4002'
//         );
//         $this->assertSame(
//             'Title is too short.',
//             $response->search('Messages[0].Message'),
//             'Title too short: ErrorMessage is doesn not contains'
//             . 'Title is too short.'
//         );
//         $this->assertSame(
//             1,
//             $response->search('Messages[0].Severity'),
//             'Title too short: ErrorSeverity is not Warning (1)'
//         );
//         $this->assertCount(
//             1,
//             $response->search('EntityList[0]'),
//             'Title too long: EntityList is empty - Product was not created'
//         );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      * @expectedException \Vws\Blackbox\Exception\BlackboxException
//      */
//     public function testPostProductValidationDescriptionError(
//         $product,
//         $exceptedMessagesCount,
//         $expectedEntityListCount
//     )
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Description'] = '';
//         $client = $this->createClient();
//
//         $response = $client->postProduct($tmpProduct);
//         $this->assertSame(
//             4019,
//             $response->search('Messages[0].Code'),
//             'Empty Description: ErrorCode is not equal to 4019'
//         );
//         $this->assertSame(
//             'Description cannot be empty',
//             $response->search('Messages[0].Message'),
//             'Empty Description: ErrorMessage is doesn not contains'
//             . '"Description cannot be empty"'
//         );
//         $this->assertSame(
//             2,
//             $response->search('Messages[0].Severity'),
//             'Empty Description: ErrorSeverity is not Error (2)'
//         );
//         $this->assertEmpty(
//             $response->search('Messages[1]'),
//             'Empty Description: Messages contains more than one elements.'
//         );
//         $this->assertEmpty(
//             $response->search('EntityList'),
//             'Empty Description: EntityList is not empty'
//         );
//
//         // missing Description
//         $tmpProduct = $product;
//         unset($tmpProduct['Description']);
//         $client = $this->createClient();
//         $response = $client->postProduct($tmpProduct);
//
//         $this->assertSame(
//             4019,
//             $response->search('Messages[0].Code'),
//             'Missing Description: ErrorCode is not equal to 4019'
//         );
//         $this->assertSame(
//             'Description cannot be empty',
//             $response->search('Messages[0].Message'),
//             'Missing Description: ErrorMessage is doesn not contains'
//             . '"Description cannot be empty"'
//         );
//         $this->assertSame(
//             2,
//             $response->search('Messages[0].Severity'),
//             'Missing Description: ErrorSeverity is not Error (2)'
//         );
//         // $this->assertEmpty(
//         //     $response->search('Messages[1]'),
//         //     'Missing Description: Messages contains more than one elements.'
//         // );
//         $this->assertEmpty(
//             $response->search('EntityList'),
//             'Missing Description: EntityList is not empty'
//         );
//
//         // $this->markTestIncomplete(
//         //     'Post Single Product (Validation Description): This test has not been implemented yet.'
//         // );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationShortDescriptionWarning(
//         $product,
//         $exceptedMessagesCount,
//         $expectedEntityListCount
//     )
//     {
//         $tmpProduct = $product;
//         $tmpProduct['ShortDescription'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce blandit vestibulum tristique. Nulla id eros vel massa ultricies feugiat quis a ex. Praesent laoreet augue vitae risus ultrices, eu dictum nunc sodales. Sed non nisi neque. Mauris a bibendum eros. Phasellus quis rhoncus lorem, in porttitor lacus. Proin id massa vel odio rutrum varius. Fusce consequat fermentum nulla in lacinia. Aliquam ornare eleifend dui. Praesent ut venenatis risus, eget porttitor leo. Integer gravida in risus et mollis. Vivamus fermentum leo nisi, non fringilla sem pellentesque eleifend. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris sed feugiat orci.
//
// Donec laoreet porttitor gravida. Nam hendrerit felis a convallis ornare. Aenean ullamcorper, massa sed accumsan laoreet, velit urna tempus urna, nec tempor elit urna eu arcu. Cras vestibulum risus sit amet lacus varius, nec consequat mi porta. Etiam sapien dui, lacinia in dapibus et, egestas eget elit. Aenean mattis elit sed vulputate malesuada. Nulla sed nunc in enim porttitor efficitur. Proin et libero feugiat, vestibulum nibh nec, rutrum nibh. Mauris efficitur turpis a velit ultricies hendrerit. Nunc sit amet risus ac erat porta gravida. Nunc malesuada consectetur sapien, vitae tincidunt sem scelerisque ut. Proin ut risus tempor, commodo lorem in, bibendum libero. Quisque hendrerit, lacus ut mattis imperdiet, ex magna egestas mi, eget mattis dui tortor in lorem. Duis in dolor euismod, pharetra lorem sed, vehicula arcu.
//
// Sed eu eleifend odio, ut tincidunt leo. Aliquam pretium finibus magna eget viverra. Praesent a elit sit amet arcu pretium iaculis. Sed condimentum eu turpis pretium ullamcorper. Etiam lobortis urna quis mi rutrum pulvinar. Integer ultrices quis urna in feugiat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
//
// Nam a porta arcu. Nulla at augue facilisis, sagittis augue vitae, fermentum dui. Aenean ac cursus lorem. In hac habitasse posuere.';
//
//         $client = $this->createClient();
//
//         $response = $client->postProduct($tmpProduct);
//         $this->assertSame(
//             4014,
//             $response->search('Messages[0].Code'),
//             'ErrorCode is not equal to 4014'
//         );
//         $this->assertSame(
//             'ShortDescription is too long',
//             $response->search('Messages[0].Message'),
//             'ShortDescription too long: ErrorMessage is doesn not contains'
//             . 'ShortDescription is too long'
//         );
//         $this->assertSame(
//             1,
//             $response->search('Messages[0].Severity'),
//             'ShortDescription too long: ErrorSeverity is not Warning (1)'
//         );
//         $this->assertCount(
//             $response->search('EntityList[0]'),
//             'ShortDescription too long: EntityList is not empty'
//         );
//
//         // $this->markTestIncomplete(
//         //     'Post Single Product (Validation ShortDescription): This test has not been implemented yet.'
//         // );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationStockAmount($product)
//     {
//         $tmpProduct = $product;
//         $tmpProduct['StockAmount'] = '';
//         $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//         //
//         // $tmpProduct = $product;
//         // unset($tmpProduct['StockAmount']);
//         // $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         //
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//
//         $this->markTestIncomplete(
//             'Post Single Product (Validation StockAmount): This test has not been implemented yet.'
//         );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationPrice($product)
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Price'] = '';
//         $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//         //
//         // $tmpProduct = $product;
//         // unset($tmpProduct['Price']);
//         // $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         //
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//
//         $this->markTestIncomplete(
//             'Post Single Product (Validation Price): This test has not been implemented yet.'
//         );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationEan($product)
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Ean'] = '';
//         $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//         //
//         // $tmpProduct = $product;
//         // unset($tmpProduct['Ean']);
//         // $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         //
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//
//         $this->markTestIncomplete(
//             'Post Single Product (Validation Ean): This test has not been implemented yet.'
//         );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationUpc($product)
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Upc'] = '';
//         $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//         //
//         // $tmpProduct = $product;
//         // unset($tmpProduct['Upc']);
//         // $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         //
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//
//         $this->markTestIncomplete(
//             'Post Single Product (Validation Upc): This test has not been implemented yet.'
//         );
//     }
//
//     /**
//      * @dataProvider productDataProvider
//      */
//     public function testPostProductValidationIsbn($product)
//     {
//         $tmpProduct = $product;
//         $tmpProduct['Isbn'] = '';
//         $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//         //
//         // $tmpProduct = $product;
//         // unset($tmpProduct['Isbn']);
//         // $client = $this->createClient();
//         // $response = $client->postProduct($tmpProduct);
//         //
//         // $this->assertSame(
//         //     4000,
//         //     $response->search('Messages[0].Code'),
//         //     'ErrorCode is not equal to 4000'
//         // );
//         // $this->assertSame(
//         //     'Title cannot be empty.',
//         //     $response->search('Messages[0].Message'),
//         //     'ErrorMessage is doesn not contains'
//         //     . 'Title cannot be empty.'
//         // );
//         // $this->assertSame(
//         //     2,
//         //     $response->search('Messages[0].Severity'),
//         //     'ErrorSeverity is not Error (2)'
//         // );
//         // $this->assertEmpty($response->search('EntityList'), 'EntityList is not empty');
//
//         $this->markTestIncomplete(
//             'Post Single Product (Validation Isbn): This test has not been implemented yet.'
//         );
//     }
//
//     // public function testPostProductListEnsureBodyContainsCorrectResult ()
//     // {
//     //     $args = [
//     //         'region'  => 'sandbox',
//     //         'profile' => 'integ-sandbox',
//     //         'version' => 'latest',
//     //     ];
//     //     $client = $this->getSdk()->createBlackbox($args);
//     //
//     //     $product = [
//     //         [
//     //             'ForeignId' => $this->getGUID(),
//     //             'Title' => 'Integration-Smoke-Test 2',
//     //             'Description' => 'Beschreibung',
//     //             'ShortDescription' => 'Kurzbeschreibung',
//     //             'Price' => 1.23,
//     //             'Ean' => '3492703010',
//     //             'StockAmount' => 10,
//     //             'ProductImages' => [
//     //                 'ForeignId' => $this->getGUID(),
//     //                 'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_2.jpg',
//     //                 'Type' => 1
//     //             ],
//     //         ],
//     //         [
//     //             'ForeignId' => $this->getGUID(),
//     //             'Title' => 'Integration-Smoke-Test 3',
//     //             'Description' => 'Beschreibung',
//     //             'ShortDescription' => 'Kurzbeschreibung',
//     //             'Price' => 1.25,
//     //             'Ean' => 'abc123',
//     //             'StockAmount' => 7,
//     //             'ProductImages' => [
//     //                 'ForeignId' => $this->getGUID(),
//     //                 'ImageUrl' => 'http://bilder.afterbuy.de/images/80694/3p0yhxug36592testartikel_3.jpg',
//     //                 'Type' => 1
//     //             ],
//     //         ]
//     //     ];
//     //
//     //     // $response = $client->postProduct($product);
//     //
//     //     $this->markTestIncomplete(
//     //         'Post Single Product: This test has not been implemented yet.'
//     //     );
//     // }
//
//     /**
//      *
//      */
//     public function testGetProductsWithoutQueryParams()
//     {
//         $client = $this->createClient();
//         $paginator = $client->getPaginator('GetProducts');
//         $paginator->next();
//
//         $this->assertSame(
//             'KS8803101',
//             $paginator->current()->search('EntityList[0].ForeignId'),
//             'EntityList[0].ForeignId is not equal to KS8803101'
//         );
//         $this->assertSame(
//             'SO6002816',
//             $paginator->current()->search('EntityList[23].ForeignId'),
//             'EntityList[23].ForeignId is not equal to SO6002816'
//         );
//         $this->assertSame(
//             'KK10C02701',
//             $paginator->current()->search('EntityList[42].ForeignId'),
//             'EntityList[42].ForeignId is not equal to KK10C02701'
//         );
//         $this->assertSame(
//             'SJW237106',
//             $paginator->current()->search('EntityList[99].ForeignId'),
//             'EntityList[99].ForeignId is not equal to SJW237106'
//         );
//         $this->assertSame(
//             100,
//             $paginator->current()->search('Pagination.EntriesPerPage'),
//             'Pagination.EntriesPerPage is not equal to 100 (default)'
//         );
//         $this->assertSame(
//             1,
//             $paginator->current()->search('Pagination.PageNumber'),
//             'Pagination.PageNumber is not equal to 1 (default)'
//         );
//         $this->assertSame(
//             false,
//             $paginator->current()->search('Pagination.HasPreviousPage'),
//             'Pagination.HasPreviousPage is not equal to false'
//         );
//         $this->assertSame(
//             true,
//             $paginator->current()->search('Pagination.HasNextPage'),
//             'Pagination.HasNextPage is not equal to true'
//         );
//         $this->assertEmpty($paginator->current()->search('Messages'), 'Messages is not empty');
//     }
//
//     /**
//      *
//      */
//     public function testGetProductsWithQueryParamsEntriesPerPage10PageNumber10()
//     {
//         $client = $this->createClient();
//         $paginator = $client->getPaginator('GetProducts', ['limit' => 10, 'page' => 10]);
//         $paginator->next();
//
//         $this->assertSame(
//             'SHW233605',
//             $paginator->current()->search('EntityList[0].ForeignId'),
//             'EntityList[0].ForeignId is not equal to SHW233605'
//         );
//         $this->assertSame(
//             'SJW237106',
//             $paginator->current()->search('EntityList[9].ForeignId'),
//             'EntityList[9].ForeignId is not equal to SJW237106'
//         );
//         $this->assertSame(
//             10,
//             $paginator->current()->search('Pagination.EntriesPerPage'),
//             'Pagination.EntriesPerPage is not equal to given 10'
//         );
//         $this->assertSame(
//             10,
//             $paginator->current()->search('Pagination.PageNumber'),
//             'Pagination.PageNumber is not equal to given 10'
//         );
//         $this->assertSame(
//             true,
//             $paginator->current()->search('Pagination.HasPreviousPage'),
//             'Pagination.HasPreviousPage is not equal to true'
//         );
//         $this->assertSame(
//             true,
//             $paginator->current()->search('Pagination.HasNextPage'),
//             'Pagination.HasNextPage is not equal to true'
//         );
//         $this->assertEmpty($paginator->current()->search('Messages'), 'Messages is not empty');
//     }
}
