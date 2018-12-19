<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use ArrayIterator;
use Mcneely\Core\CoreObject;

/**
 * Trait JsonSerializableTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method CoreObject CoreTrait_getCoreObject()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait JsonSerializableTrait
{
    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this
            ->CoreTrait_getCoreObject()
            ->unWrap(ArrayIterator::class)
        ;

        if ($object instanceof ArrayIterator) {
            return $object->getArrayCopy();
        }

        return (array) $object;
    }
}
