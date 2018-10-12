<?php

namespace Mcneely\Core\Traits;

/**
 * Trait GeneratorTrait
 *
 * @package Mcneely\Core\Traits
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 */
trait GeneratorTrait
{
    protected function __setUp_GeneratorTrait()
    {
        $this->getCoreObject_CoreTrait()->setRetriever(
            function ($object) {
                foreach ($object as $key => $value) {
                    yield $key => $value;
                }
            }
        );
    }
}