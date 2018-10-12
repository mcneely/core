<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 10/9/18
 * Time: 10:13 PM
 */

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\CountableTrait;
use PHPUnit\Framework\TestCase;

class CountableTestClass implements \Countable
{
    use CoreTrait;
    use CountableTrait;

    public function __construct($object)
    {
        $this->setCoreObject_CoreTrait($object);
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

    }

}