<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 10/11/18
 * Time: 9:00 PM
 */

namespace tests\Traits;


use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\IteratorTrait;
use PHPStan\Testing\TestCase;

class IteratorTraitTest extends TestCase
{
    use CoreTrait;
    use IteratorTrait;

    public function setUp()
    {
        $this->setCoreObject_CoreTrait(new \ArrayIterator([1, 2]));
    }

    public function testKey() {
        $this->next();
        $this->assertEquals(1, $this->key());
    }

    public function testCurrent() {
        $this->assertEquals(1, $this->current());
    }

    public function testValidRewind() {
        $this->next();
        $this->next();
        $this->assertFalse($this->valid());
        $this->rewind();
        $this->assertTrue($this->valid());
    }
}