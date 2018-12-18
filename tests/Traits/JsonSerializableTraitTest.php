<?php

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\JsonSerializableTrait;
use PHPUnit\Framework\TestCase;
use SplFixedArray;

class FunctionTestClass
{
    private $object;

    public function __construct(array $object)
    {
        $this->object = $object;
    }

    public function toArray() {
        return $this->object;
    }
}

class JsonSerializableTraitTest extends TestCase implements \JsonSerializable
{
    use CoreTrait;
    use JsonSerializableTrait;

    public function testGenerator()
    {
        $array = [1, 2];
        $this->CoreTrait_setCoreObject($array);
        $this->assertEquals($array, $this->jsonSerialize());
        $this->CoreTrait_setCoreObject(SplFixedArray::fromArray($array));
        $this->assertEquals($array, $this->jsonSerialize());
        $generator = function ($object) {
            foreach ($object as $key => $value) {
                yield $key => $value;
            }
        };
        $this->CoreTrait_setCoreObject($generator($array));
        $this->assertEquals($array, $this->jsonSerialize());
        $this->assertEquals($array, $this->jsonSerialize());
        $this->CoreTrait_setCoreObject((object) $array);
        $this->assertEquals($array, $this->jsonSerialize());
        $this->assertEquals(json_encode($array), json_encode($this));

        $function = new FunctionTestClass($array);
        $this->CoreTrait_setCoreObject($function);
        $this->assertEquals($array, $this->jsonSerialize());
    }
}
