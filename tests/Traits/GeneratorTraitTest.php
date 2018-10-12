<?php

namespace tests\Traits;


use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\GeneratorTrait;
use PHPUnit\Framework\TestCase;

class GeneratorTraitTest extends TestCase
{
    use CoreTrait;
    use GeneratorTrait;

    public function testGenerator()
    {
        $this->setCoreObject_CoreTrait([1, 2]);
        $this->assertInstanceOf('Generator', $this->getCoreObject_CoreTrait()->getObject());
        foreach ($this->getCoreObject_CoreTrait()->getObject() as $value) {
        }
        $this->assertEquals($value, 2);
    }

}