<?php

namespace Vws\Test\Integ;

use Vws\Sdk;
use GuzzleHttp\Command\Event\PreparedEvent;

class BlackboxClientAuthorizationSmokeTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException \Vws\Blackbox\Exception\BlackboxException
    * @expectedExceptionMessage (client error): The header parameter "Username" or "Password" is not valid or empty
    */
    public function testAuthorizationEmptyMissingInvalidUsernameEnsureHeaderIsCorrectAndBodyContainsCorrectMessage()
    {
        $args = [
          'region'  => 'sandbox',
          'profile' => 'integ-sandbox-empty-username',
          'version' => 'latest',
          'scheme'  => 'http',
        ];
        $client = (new Sdk())->createClient('blackbox', $args);
        $response = $client->getCatalogs();

        $this->assertSame(
            401,
            $response->getStatusCode(),
            'Response StatusCode is not 401'
        );
        $this->assertSame(
            1000,
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 1000'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Error (2)'
        );
        $this->assertSame(
            'The header parameter "Username" or "Password" is not valid or empty.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '"The header parameter "Username" or "Password" is not valid or empty."'
        );

        // wrong username

        $args = [
          'region'  => 'sandbox',
          'profile' => 'integ-sandbox-wrong-username',
          'version' => 'latest',
          'scheme'  => 'http',
        ];

        $response = $client->getCatalogs($args);

        $response->getHttpClient();

        $this->assertSame(
            401,
            $response->getStatusCode(),
            'Response StatusCode is not 401'
        );
        $this->assertSame(
            1000,
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 1000'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Error (2)'
        );
        $this->assertSame(
            'The header parameter "Username" or "Password" is not valid or empty.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '"The header parameter "Username" or "Password" is not valid or empty."'
        );

        // no username

        $client->getEmitter()->on('prepared', function (PreparedEvent $event) {
            $request = $event->getRequest();
            $request->removeHeader('Username');
        }, 'last');

        $response = $client->getCatalogs();

        $this->assertSame(
            401,
            $response->getStatusCode(),
            'Response StatusCode is not 401'
        );
        $this->assertSame(
            1000,
            $response->search('Messages[0].Code'),
            'Messages[0].Code is not 1000'
        );
        $this->assertSame(
            2,
            $response->search('Messages[0].Severity'),
            'Messages[0].Severity is not Error (2)'
        );
        $this->assertSame(
            'The header parameter "Username" or "Password" is not valid or empty.',
            $response->search('Messages[0].Message'),
            'Messages[0].Message does not contains '
            . '"The header parameter "Username" or "Password" is not valid or empty."'
        );
    }

    /**
     * @expectedException \Vws\Blackbox\Exception\BlackboxException
     * @expectedExceptionMessage (client error): The header parameter "Username" or "Password" is not valid or empty
     */
    public function testAuthorizationEmptyMissingOrInvalidPasswordEnsureHeaderIsCorrectAndBodyContainsCorrectMessage()
    {
         $args = [
           'region'  => 'sandbox',
           'profile' => 'integ-sandbox-empty-password',
           'version' => 'latest',
           'scheme'  => 'http',
         ];
         $client = (new Sdk())->createClient('blackbox', $args);
         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1000,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1000'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "Username" or "Password" is not valid or empty.',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "Username" or "Password" is not valid or empty."'
         );

         // invalid password

         $args = [
           'region'  => 'sandbox',
           'profile' => 'integ-sandbox-wrong-password',
           'version' => 'latest',
           'scheme'  => 'http',
         ];
         $client = (new Sdk())->createClient('blackbox', $args);
         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1000,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1000'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "Username" or "Password" is not valid or empty.',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "Username" or "Password" is not valid or empty."'
         );

         // no username

         $client->getEmitter()->on('prepared', function (PreparedEvent $event) {
             $request = $event->getRequest();
             $request->removeHeader('Password');
         }, 'last');

         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1000,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1000'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "Username" or "Password" is not valid or empty.',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "Username" or "Password" is not valid or empty."'
         );
    }

    /**
     * @expectedException \Vws\Blackbox\Exception\BlackboxException
     * @expectedExceptionMessage (client error): The header parameter "SubscriptionToken" is not valid or empty
     */
    public function testAuthorizationEmptyMissingOrInvalidSubscriptionTokenEnsureHeaderIsCorrectAndBodyContainsCorrectMessage()
    {
         $args = [
           'region'  => 'sandbox',
           'profile' => 'integ-sandbox-wrong-subscription_token',
           'version' => 'latest',
           'scheme'  => 'http',
         ];
         $client = (new Sdk())->createClient('blackbox', $args);
         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1001,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1001'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "SubscriptionToken" is not valid or empty',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "SubscriptionToken" is not valid or empty"'
         );

         // no username

         $client->getEmitter()->on('prepared', function (PreparedEvent $event) {
             $request = $event->getRequest();
             $request->removeHeader('SubscriptionToken');
         }, 'last');

         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1001,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1001'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "SubscriptionToken" is not valid or empty',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "SubscriptionToken" is not valid or empty"'
         );
    }

    /**
     * @expectedException \Vws\Blackbox\Exception\BlackboxException
     * @expectedExceptionMessage (client error): The header parameter "Vendor" is not valid or empty.
     */
    public function testAuthorizationEmptyOrMissingVendorEnsureHeaderIsCorrectAndResponseContainsCorrectMessage()
    {
         $args = [
           'region'  => 'sandbox',
           'profile' => 'integ-sandbox',
           'version' => 'latest',
           'scheme'  => 'http',
         ];
         $client = (new Sdk())->createClient('blackbox', $args);

         $client->getEmitter()->on('prepared', function (PreparedEvent $event) {
             $request = $event->getRequest();
             $request->setHeader('Vendor', '');
         }, 'last');

         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1001,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1001'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "Vendor" is not valid or empty.',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "Vendor" is not valid or empty."'
         );

         $client->getEmitter()->on('prepared', function (PreparedEvent $event) {
             $request = $event->getRequest();
             $request->removeHeader('Vendor');
         }, 'last');

         $response = $client->getCatalogs();

         $this->assertSame(
             401,
             $response->getStatusCode(),
             'Response StatusCode is not 401'
         );
         $this->assertSame(
             1001,
             $response->search('Messages[0].Code'),
             'Messages[0].Code is not 1001'
         );
         $this->assertSame(
             2,
             $response->search('Messages[0].Severity'),
             'Messages[0].Severity is not Error (2)'
         );
         $this->assertSame(
             'The header parameter "Vendor" is not valid or empty.',
             $response->search('Messages[0].Message'),
             'Messages[0].Message does not contains '
             . '"The header parameter "Vendor" is not valid or empty."'
         );
    }
}
