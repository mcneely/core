<?php

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
        $this->CoreTrait_setCoreObject($this->object);
        $this->CoreTrait_registerEvent('testRegisteredEvent', function () {
            $this->registeredEventFired = true;
        });
    }

    public function testIsInstanceOf()
    {
        $this->assertTrue($this->CoreTrait_getCoreObject()->isInstanceOf(get_class($this->object)));
        $this->assertFalse($this->CoreTrait_getCoreObject()->isInstanceOf('string'));
    }

    public function testHasMethod()
    {
        $this->assertTrue($this->CoreTrait_getCoreObject()->hasMethod('__construct'));
        $this->assertFalse($this->CoreTrait_getCoreObject()->hasMethod('NoThisIsNotARealMethod'));
    }

    public function testGetClass()
    {
        $this->assertEquals(get_class($this->object), $this->CoreTrait_getCoreObject()->getClass());
    }

    public function testBeforeMethod()
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);
        $this->assertTrue($this->beforeMethodFired);
    }

    public function __fireBefore_testBeforeMethod()
    {
        $this->beforeMethodFired = true;
    }

    public function testRegisteredEvent()
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);
        $this->assertTrue($this->registeredEventFired);
    }
}
