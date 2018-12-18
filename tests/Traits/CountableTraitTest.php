<?php

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\CountableTrait;
use PHPUnit\Framework\TestCase;

class CountTestClass
{
    use CoreTrait;
    use CountableTrait;

    public function __construct($object)
    {
        $this->CoreTrait_setCoreObject($object);
    }
}

class CountableTestClass implements \Countable
{
    use CoreTrait;
    use CountableTrait;

    public function __construct($object)
    {
        $this->CoreTrait_setCoreObject($object);
    }
}

class CountableTraitTest extends TestCase
{
    public function testCountable()
    {
        $array     = [1, 2, 3];
        $countable = new CountableTestClass($array);
        $this->assertEquals(3, count($countable));
        $countable = new CountableTestClass(new \ArrayObject($array));
        $this->assertEquals(3, count($countable));
        $generator = function ($object) {
            foreach ($object as $key => $value) {
                yield $key => $value;
            }
        };
        $countable = new CountableTestClass($generator($array));
        $this->assertEquals(3, count($countable));
        $this->assertEquals(3, count($countable));
        $countable = new CountTestClass(new \ArrayObject($array));
        $this->assertEquals(3, $countable->count());
        $countable = new CountableTestClass((object) $array);
        $this->assertEquals(1, count($countable));
        $countable = new CountableTestClass(null);
        $this->assertEquals(0, count($countable));
    }
}
