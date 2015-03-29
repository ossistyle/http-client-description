<?php
namespace Vws\Test\Api;

use Vws\Api\ShapeMap;
use Vws\Api\ListShape;

/**
 * @covers \Vws\Api\ListShape
 */
class ListShapeTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsMember()
    {
        $s = new ListShape(
            ['member' => ['type' => 'string']],
            new ShapeMap([])
        );

        $m = $s->getMember();
        $this->assertInstanceOf('Vws\Api\Shape', $m);
        $this->assertSame($m, $s->getMember());
        $this->assertEquals('string', $m->getType());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testFailsWhenMemberIsMissing()
    {
        (new ListShape([], new ShapeMap([])))->getMember();
    }
}
