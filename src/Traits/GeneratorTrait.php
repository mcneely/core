<?php
declare(strict_types = 1);

namespace Mcneely\Core\Traits;

use Mcneely\Core\CoreObject;

/**
 * Trait GeneratorTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method CoreObject CoreTrait_getCoreObject()
 */
trait GeneratorTrait
{
    protected function __setUp_GeneratorTrait(): void
    {
        $this->CoreTrait_getCoreObject()->setRetriever(
            function ($object) {
                foreach ($object as $key => $value) {
                    yield $key => $value;
                }
            }
        );
    }
}
