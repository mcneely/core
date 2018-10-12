<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 10/9/18
 * Time: 8:59 PM
 */

namespace tests\Traits;

use Mcneely\Core\Traits\ArrayAccessTrait;
use Mcneely\Core\Traits\CoreTrait;
use PHPUnit\Framework\TestCase;

class ArrayAccessTraitTest extends TestCase
{
    use CoreTrait;
    use ArrayAccessTrait;

    public function setUp()
    {
        $this->setCoreObject_CoreTrait(
            new \ArrayObject(
                [
                    'Test1' => 'Test',
                    'Test2' => 'Test',
                ]
            )
        );
    }

    public function testOffsetExists()
    {
        $this->assertTrue($this->offsetExists('Test2'));
        $this->assertFalse($this->offsetExists('Test3'));
    }


    public function testOffsetSetGetUnset()
    {
        $this->offsetSet('Test4', 'Test');
        $this->assertEquals($this->offsetGet('Test4'), 'Test');
        $this->offsetUnset('Test4');
        $this->assertFalse($this->offsetExists('Test4'));
    }


}
