<?php
namespace Vws\Test\Integ;

use Vws\Exception\VwsException;
use GuzzleHttp\Event\BeforeEvent;

class ClientSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     * @dataProvider provideServiceTestCases
     */
    public function testBasicOperationWorks($service, $class, $options,
        $endpoint, $operation, $params, $succeed, $value
    ) {
        // Create the client and make sure it is the right class.
        $client = $this->getVdk()->getClient($service, $options);
        $this->assertInstanceOf($class, $client);

        // Setup event to get the request's host value.
        $host = null;
        $client->getHttpClient()->getEmitter()->on(
            'before',
            function (BeforeEvent $event) use (&$host) {
                $host = $event->getRequest()->getHost();
            }
        );

        // Execute the request and check if it behaved as intended.
        try {
            // Execute the operation.
            $result = $client->execute($client->getCommand($operation, $params));
            if (!$succeed) {
                $this->fail("The {$operation} operation of the {$service} "
                    . "service was supposed to fail.");
            }

            // Examine the result.
            if ($value !== null) {
                // Ensure the presence of the specified key.
                $this->assertArrayHasKey($value, $result);
            }
        } catch (VwsException $e) {
            if ($succeed) {
                $this->fail("The {$operation} operation of the {$service} "
                    . "service was supposed to succeed.");
            }

            // The exception class should have the same namespace as the client.
            $this->assertStringStartsWith(
                substr($class, 0, strrpos($class, '\\')),
                get_class($e)
            );

            // Look at the error code first, then the root exception class, to
            // see if it matches the value.
            $error = $e;
            while ($error->getPrevious()) {
                $error = $error->getPrevious();
            }
            $this->assertEquals(
                $value,
                $e->getVwsErrorCode() ?: get_class($error),
                $e->getMessage()
            );
        } catch (\Exception $e) {
            // If something other than an AwsException was thrown, then
            // something really went wrong.
            $this->fail('An unexpected exception occurred: ' . get_class($e)
                . ' - ' . $e->getMessage());
        }

        // Ensure the request's host is correct no matter the outcome.
        $this->assertEquals($endpoint, $host);
    }

    public function provideServiceTestCases()
    {
        return [
            /*[
                service (client to create `Vdk::getClient()`)
                class (expected class name of instantiated client)
                options (client options; besides region, version, & credentials)
                endpoint (expected host of the request)
                operation (service operation to execute)
                params (parameters to use for the operation)
                succeeds (bool - whether or not the request should succeed)
                value (a key that should be present in the result
                       OR... the error code, in the case of failure)
            ],*/
            [
                'blackbox',
                'Vws\\Blackbox\\BlackboxClient',
                [],
                'local.via.de',
                'GetCatalogs',
                [],
                true,
                '0'
            ],
            [
                'blackbox',
                'Vws\\Blackbox\\BlackboxClient',
                [],
                'local.via.de',
                'GetCatalogById',
                ['Id' => 134827],
                true,
                'Id'
            ],
            [
                'blackbox',
                'Vws\\Blackbox\\BlackboxClient',
                [],
                'local.via.de',
                'GetCatalogById',
                ['Id' => 0815],
                false,
                'GuzzleHttp\Exception\ClientException'
            ],
        ];
    }
}
