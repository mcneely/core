<?php

namespace tests\Traits;

use Mcneely\Core\Traits\CoreTrait;
use Mcneely\Core\Traits\JsonSerializableTrait;
use PHPUnit\Framework\TestCase;
use SplFixedArray;

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
        $this->CoreTrait_setCoreObject((object) $array);
        $this->assertEquals($array, $this->jsonSerialize());
    }
}
