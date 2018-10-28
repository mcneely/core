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
        $this->setCoreObject_CoreTrait($array);
        $this->assertEquals($array, $this->jsonSerialize());
        $this->setCoreObject_CoreTrait(SplFixedArray::fromArray($array));
        $this->assertEquals($array, $this->jsonSerialize());
        $generator = function ($object) {
            foreach ($object as $key => $value) {
                yield $key => $value;
            }
        };
        $this->setCoreObject_CoreTrait($generator($array));
        $this->assertEquals($array, $this->jsonSerialize());
        $this->setCoreObject_CoreTrait((object) $array);
        $this->assertEquals($array, $this->jsonSerialize());
    }
}
