<?php
namespace Vws\Test\Api;

use Vws\Api\ShapeMap;
use Vws\Api\MapShape;

/**
 * @covers \Vws\Api\MapShape
 */
class MapShapeTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsValue()
    {
        $s = new MapShape(['value' => ['type' => 'string']], new ShapeMap([]));
        $v = $s->getValue();
        $this->assertInstanceOf('Vws\Api\Shape', $v);
        $this->assertEquals('string', $v->getType());
        $this->assertSame($v, $s->getValue());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testFailsWhenValueIsMissing()
    {
        (new MapShape([], new ShapeMap([])))->getValue();
    }

    public function testReturnsKey()
    {
        $s = new MapShape(['key' => ['type' => 'string']], new ShapeMap([]));
        $k = $s->getKey();
        $this->assertInstanceOf('Vws\Api\Shape', $k);
        $this->assertEquals('string', $k->getType());
    }

    public function testReturnsEmptyKey()
    {
        $s = new MapShape([], new ShapeMap([]));
        $this->assertInstanceOf('Vws\Api\Shape', $s->getKey());
    }
}
