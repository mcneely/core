<?php

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\IteratorTrait;
use PHPUnit\Framework\TestCase;

class IteratorTraitTest extends TestCase
{
    use CoreTrait;
    use IteratorTrait;

    public function setUp()
    {
        $this->CoreTrait_setCoreObject(new \ArrayIterator(['A' => 1, 'B' => 2]));
    }

    public function testKey()
    {
        $this->next();
        $this->assertEquals('B', $this->key());
    }

    public function testCurrent()
    {
        $this->assertEquals(1, $this->current());
    }

    public function testValidRewind()
    {
        $this->next();
        $this->assertEquals('B', $this->key());
        $this->next();
        $this->assertFalse($this->valid());
        $this->rewind();
        $this->assertTrue($this->valid());
        $this->assertEquals('A', $this->key());
    }
}
