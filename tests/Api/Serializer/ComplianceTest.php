<?php
namespace Vws\Test\Api\Serializer;

use Vws\Api\Service;
use Vws\VwsClient;
use Vws\Credentials\NullCredentials;
use Vws\Test\UsesServiceTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Command\CommandTransaction;

/**
 * @covers Vws\Api\Serializer\JsonRpcSerializer
 * @covers Vws\Api\Serializer\RestSerializer
 * @covers Vws\Api\Serializer\RestJsonSerializer
 * @covers Vws\Api\Serializer\JsonBody
 */
class ComplianceTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    public function testCaseProvider()
    {
        $cases = [];

        $files = glob(__DIR__ . '/../test_cases/protocols/input/*.json');
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            foreach ($data as $suite) {
                $suite['metadata']['type'] = $suite['metadata']['protocol'];
                foreach ($suite['cases'] as $case) {
                    $description = new Service(function () use ($suite, $case) {
                        return [
                            'metadata' => $suite['metadata'],
                            'shapes' => $suite['shapes'],
                            'operations' => [
                                $case['given']['name'] => $case['given']
                            ]
                        ];
                    }, 'service', 'region');
                    $cases[] = [
                        $file . ': ' . $suite['description'],
                        $description,
                        $case['given']['name'],
                        $case['params'],
                        $case['serialized']
                    ];
                }
            }
        }

        return $cases;
    }

    /**
     * @dataProvider testCaseProvider
     */
    public function testPassesComplianceTest(
        $about,
        Service $service,
        $name,
        array $args,
        $serialized
    ) {
        $ep = 'http://dus-bb-api802.dus.via.de';
        $client = new VwsClient([
            'service'      => 'foo',
            'api_provider' => function () use ($service) {
                return $service->toArray();
            },
            'credentials'  => new NullCredentials(),
            'client'       => new Client(),
            'region'       => 'sandbox-new',
            'endpoint'     => $ep,
            'error_parser' => Service::createErrorParser($service->getProtocol()),
            'serializer'   => Service::createSerializer($service, $ep),
            'version'      => 'latest'
        ]);

        $command = $client->getCommand($name, $args);
        $trans = new CommandTransaction($client, $command);
        /** @var callable $serializer */
        $serializer = $this->readAttribute($client, 'serializer');
        $request = $serializer($trans);
        $this->assertEquals($serialized['uri'], $request->getResource());

        $body = (string) $request->getBody();
        switch ($service->getMetadata('type')) {
            case 'json':
            case 'rest-json':
                // Normalize the JSON data.
                $body = str_replace(':', ': ', $request->getBody());
                $body = str_replace(',', ', ', $body);
                break;
        }

        $this->assertEquals($serialized['body'], $body);

        if (isset($serialized['headers'])) {
            foreach ($serialized['headers'] as $key => $value) {
                $this->assertSame($value, $request->getHeader($key));
            }
        }
    }
}
