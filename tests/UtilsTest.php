<?php

namespace Vws\Test;

use Vws\Utils;

/**
 * @covers Vws\Utils
 */
class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatesRecursiveDirIterator()
    {
        $iter = Utils::recursiveDirIterator(__DIR__);
        $this->assertInstanceOf('Iterator', $iter);
        $files = iterator_to_array($iter);
        $this->assertContains(__FILE__, $files);
    }
    public function testCreatesNonRecursiveDirIterator()
    {
        $iter = Utils::dirIterator(__DIR__);
        $this->assertInstanceOf('Iterator', $iter);
        $files = iterator_to_array($iter);
        $this->assertContains('UtilsTest.php', $files);
    }
    public function testComposesOrFunctions()
    {
        $a = function ($a, $b) {
            return null;
        };
        $b = function ($a, $b) {
            return $a . $b;
        };
        $c = function ($a, $b) {
            return 'C';
        };
        $comp = Utils::orFn($a, $b, $c);
        $this->assertEquals('+-', $comp('+', '-'));
    }
    public function testReturnsNullWhenNonResolve()
    {
        $called = [];
        $a = function () use (&$called) {
            $called[] = 'a';
        };
        $b = function () use (&$called) {
            $called[] = 'b';
        };
        $c = function () use (&$called) {
            $called[] = 'c';
        };
        $comp = Utils::orFn($a, $b, $c);
        $this->assertNull($comp());
        $this->assertEquals(['a', 'b', 'c'], $called);
    }
}
