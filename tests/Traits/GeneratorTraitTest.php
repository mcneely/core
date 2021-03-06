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
        $this->CoreTrait_setCoreObject([1, 2]);
        $this->assertInstanceOf(\Generator::class, $this->CoreTrait_getCoreObject()->unWrap(\Generator::class));
        $value = $this->CoreTrait_getCoreObject()->unWrap(\Generator::class)->current();
        $this->assertEquals(1, $value);
        $this->CoreTrait_getCoreObject()->unWrap(\Generator::class)->next();
        $value = $this->CoreTrait_getCoreObject()->unWrap(\Generator::class)->current();
        $this->assertEquals(2, $value);
    }
}
