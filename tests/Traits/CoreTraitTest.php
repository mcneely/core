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

class CoreTraitTest extends TestCase
{
    use CoreTrait;
    protected $object;
    protected $beforeMethodFired = false;
    protected $registeredEventFired = false;

    public function setUp()
    {
        $this->object = new \ArrayObject([1, 2, 3]);
        $this->setCoreObject_CoreTrait($this->object);
        $this->registerEvent_CoreTrait('testRegisteredEvent', function() {
            $this->registeredEventFired = true;
        });
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

    public function testGetClass() {
        $this->assertEquals(get_class($this->object), $this->getCoreObject_CoreTrait()->getClass());
    }

    public function testBeforeMethod()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);
        $this->assertTrue($this->beforeMethodFired);
    }

    public function __fireBefore_testBeforeMethod()
    {
        $this->beforeMethodFired = true;
    }

    public function testRegisteredEvent() {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);
        $this->assertTrue($this->registeredEventFired);
    }
}