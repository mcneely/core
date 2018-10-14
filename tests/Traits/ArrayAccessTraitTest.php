<?php

namespace tests\Traits;

use Mcneely\Core\Traits\ArrayAccessTrait;
use Mcneely\Core\Traits\CoreTrait;
use PHPUnit\Framework\TestCase;
use IteratorIterator;

class ArrayAccessTraitTest extends TestCase
{
    use CoreTrait;
    use ArrayAccessTrait;
    protected $array = [
        'Test1' => 'Test',
        'Test2' => 'Test'
    ];

    public function setUp()
    {
        $this->setCoreObject_CoreTrait(
            new \ArrayObject($this->array)
        );
    }

    public function testOffsetExists()
    {
        $generator = function ($object) {
            foreach ($object as $key => $value) {
                yield $key => $value;
            }
        };

        $this->assertTrue($this->offsetExists('Test2'));
        $this->assertFalse($this->offsetExists('Test3'));
        $this->setCoreObject_CoreTrait(new IteratorIterator($generator($this->array)));
        $this->assertTrue($this->offsetExists('Test2'));
        $this->setCoreObject_CoreTrait(new IteratorIterator($generator($this->array)));
        $this->assertFalse($this->offsetExists('Test3'));
    }


    public function testOffsetSetGetUnset()
    {
        $generator = function ($object) {
            foreach ($object as $key => $value) {
                yield $key => $value;
            }
        };

        $this->offsetSet('Test4', 'Test');
        $this->assertEquals($this->offsetGet('Test4'), 'Test');
        $this->offsetUnset('Test2');
        $this->assertFalse($this->offsetExists('Test2'));
        $this->setCoreObject_CoreTrait(new IteratorIterator($generator($this->array)));
        $this->offsetSet('Test4', 'Test');
        $this->assertEquals($this->offsetGet('Test4'), 'Test');
        $this->setCoreObject_CoreTrait(new IteratorIterator($generator($this->array)));
        $this->offsetUnset('Test2');
        $this->assertFalse($this->offsetExists('Test2'));
    }


}
