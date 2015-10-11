<?php
namespace Vws\Test\Api;

use Vws\Api\Shape;
use Vws\Api\ShapeMap;

/**
 * @covers \Vws\Api\Shape
 * @covers \Vws\Api\AbstractModel
 */
class ShapeTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsArray()
    {
        $s = new Shape(['metadata' => ['foo' => 'bar']], new ShapeMap([]));
        $this->assertSame(['foo' => 'bar'], $s['metadata']);
        $this->assertNull($s['missing']);
        $s['abc'] = '123';
        $this->assertEquals('123', $s['abc']);
        $this->assertTrue(isset($s['abc']));
        $this->assertEquals(
            ['metadata' => ['foo' => 'bar'], 'abc' => '123'],
            $s->toArray()
        );
        unset($s['abc']);
        $this->assertFalse(isset($s['abc']));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidatesShapeAt()
    {
        $s = new Shape([], new ShapeMap([]));
        $m = new \ReflectionMethod($s, 'shapeAt');
        $m->setAccessible(true);
        $m->invoke($s, 'not_there');
    }

    public function testReturnsShapesFor()
    {
        $s = new Shape(['foo' => ['type' => 'string']], new ShapeMap([]));
        $m = new \ReflectionMethod($s, 'shapeAt');
        $m->setAccessible(true);
        $this->assertInstanceOf('Vws\Api\Shape', $m->invoke($s, 'foo'));
    }

    public function testReturnsNestedShapeReferences()
    {
        $s = new Shape(
            ['foo' => ['shape' => 'bar']],
            new ShapeMap(['bar' => ['type' => 'string']])
        );
        $m = new \ReflectionMethod($s, 'shapeAt');
        $m->setAccessible(true);
        $result = $m->invoke($s, 'foo');
        $this->assertInstanceOf('Vws\Api\Shape', $result);
        $this->assertEquals('string', $result->getType());
    }

    public function testCreatesCustomShapeReferences()
    {
        $s = Shape::create(
            ['shape' => 'bar'],
            new ShapeMap(['bar' => ['type' => 'integer', 'min' => 1, 'max' => 100, 'pattern' => '#\\b[\\d\\-]{3,18}\\b#']])
        );
        $this->assertInstanceOf('Vws\Api\Shape', $s);
        $this->assertEquals('integer', $s->getType());
        $this->assertEquals('1', $s->getMin());
        $this->assertEquals('100', $s->getMax());
        $this->assertEquals('#\\b[\\d\\-]{3,18}\\b#', $s->getPattern());
    }

    public function testCreatesNestedShapeReferences()
    {
        $s = Shape::create(
            ['shape' => 'bar'],
            new ShapeMap(['bar' => ['type' => 'float']])
        );
        $this->assertInstanceOf('Vws\Api\Shape', $s);
        $this->assertEquals('float', $s->getType());
        $this->assertEquals(false, $s->getMin());
        $this->assertEquals(false, $s->getMax());
        $this->assertEquals(false, $s->getPattern());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Invalid type
     */
    public function testValidatesShapeTypes()
    {
        $s = new Shape(
            ['foo' => ['type' => 'what?']],
            new ShapeMap([])
        );
        $m = new \ReflectionMethod($s, 'shapeAt');
        $m->setAccessible(true);
        $m->invoke($s, 'foo');
    }
}
