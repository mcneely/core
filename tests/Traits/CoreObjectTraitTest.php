<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 9/22/18
 * Time: 9:52 PM
 */

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use PHPUnit\Framework\TestCase;

class CoreObjectTraitTest extends TestCase
{
    use CoreTrait;
    protected $object;

    public function setUp()
    {
        $this->object = new \ArrayObject([]);
        $this->setCoreObject_CoreTrait($this->object);
    }

    public function testIsInstanceOf()
    {
        $this->assertTrue($this->getCoreObject_CoreTrait()->isInstanceOf(get_class($this->object)));
        $this->assertFalse($this->getCoreObject_CoreTrait()->isInstanceOf('string'));
    }

    public function testHasMethod()
    {
        $this->assertTrue($this->getCoreObject_CoreTrait()->hasMethod('__construct'));
        $this->assertFalse($this->getCoreObject_CoreTrait()->hasMethod('NoThisIsNotARealMethod'));
    }
}