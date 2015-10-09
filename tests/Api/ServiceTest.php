<?php
namespace Vws\Test\Api;

use Vws\Api\Service;
use Vws\Test\UsesServiceTrait;

/**
 * @covers \Vws\Api\Service
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    use UsesServiceTrait;

    public function testSetsDefaultValues()
    {
        $s = new Service([], function () { return []; });
        $this->assertSame([], $s['operations']);
        $this->assertSame([], $s['shapes']);
    }

    public function testImplementsArrayAccess()
    {
        $s = new Service(['metadata' => ['foo' => 'bar']], function () { return []; });
        $this->assertEquals('bar', $s['metadata']['foo']);
        $this->assertNull($s['missing']);
        $s['abc'] = '123';
        $this->assertEquals('123', $s['abc']);
        $this->assertSame([], $s['shapes']);
    }

    public function testReturnsApiData()
    {
        $s = new Service(
                [
                    'metadata' => [
                        'serviceFullName' => 'foo',
                        'endpointPrefix'  => 'bar',
                        'apiVersion'      => 'baz',
                        'protocol'        => 'yak',
                    ]
                ],
                function () { return [];}
        );
        $this->assertEquals('foo', $s->getServiceFullName());
        $this->assertEquals('bar', $s->getEndpointPrefix());
        $this->assertEquals('baz', $s->getApiVersion());
        $this->assertEquals('yak', $s->getProtocol());
    }

    public function testReturnsMetadata()
    {
        $s = new Service([], function () { return []; });
        $this->assertInternalType('array', $s->getMetadata());
        $s['metadata'] = [
            'serviceFullName' => 'foo',
            'endpointPrefix'  => 'bar',
            'apiVersion'      => 'baz'
        ];
        $this->assertEquals('foo', $s->getMetadata('serviceFullName'));
        $this->assertNull($s->getMetadata('baz'));
    }

    public function testReturnsIfOperationExists()
    {
        $s = new Service(['operations' => ['foo' => ['input' => []]]], function () { return [];});
        $this->assertTrue($s->hasOperation('foo'));
        $this->assertInstanceOf('Vws\Api\Operation', $s->getOperation('foo'));
        $this->assertArrayHasKey('foo', $s->getOperations());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEnsuresOperationExists()
    {
        $s = new Service([], function () { return []; });
        $s->getOperation('foo');
    }

    public function testCanRetrievePaginationConfig()
    {
        $expected = [
            'limit'  => 'a',
            'page' => 'b',
            'more_results' => 'e',
        ];

        // Stub out the API provider
        $service = new Service([], function () use ($expected) {
            return ['pagination' => ['foo' => $expected]];
        });
        $this->assertTrue($service->hasPaginator('foo'));
        $actual = $service->getPaginatorConfig('foo');
        $this->assertSame($expected, $actual);
    }

    // public function testLoadWaiterConfigs()
    // {
    //     $api = new Service(
    //         function () {
    //             return ['waiters' => ['Foo' => ['bar' => 'baz']]];
    //         },
    //         '',
    //         ''
    //     );
    //
    //     $this->assertTrue($api->hasWaiter('Foo'));
    //     $config = $api->getWaiterConfig('Foo');
    //     $this->assertEquals(['bar' => 'baz'], $config);
    //
    //     $this->assertFalse($api->hasWaiter('Fizz'));
    //     $this->setExpectedException('UnexpectedValueException');
    //     $api->getWaiterConfig('Fizz');
    // }

    public function errorParserProvider()
    {
        return [
            ['json', 'Vws\Api\ErrorParser\JsonRpcErrorParser'],
            ['rest-json', 'Vws\Api\ErrorParser\RestJsonErrorParser'],
        ];
    }

    /**
     * @dataProvider errorParserProvider
     */
    public function testCreatesRelevantErrorParsers($p, $cl)
    {
        $this->assertInstanceOf($cl, Service::createErrorParser($p));
    }

    public function serializerDataProvider()
    {
        return [
            ['json', 'Vws\Api\Serializer\JsonRpcSerializer'],
            ['rest-json', 'Vws\Api\Serializer\RestJsonSerializer'],
        ];
    }

    /**
     * @dataProvider serializerDataProvider
     */
    public function testCreatesSerializer($type, $parser)
    {

    }

    public function parserDataProvider()
    {
        return [
            ['json', 'Vws\Api\Parser\JsonRpcParser'],
            ['rest-json', 'Vws\Api\Parser\RestJsonParser'],
        ];
    }

    /**
     * @dataProvider parserDataProvider
     */
    public function testCreatesParsers($type, $parser)
    {

    }
}
