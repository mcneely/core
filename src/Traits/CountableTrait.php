<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use Mcneely\Core\CoreObject;

/**
 * Trait CountableTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method CoreObject CoreTrait_getCoreObject()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait CountableTrait
{
    /**
     * @return int
     */
    public function count(): int
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this
            ->CoreTrait_getCoreObject()
            ->getObject()
        ;

        if (
            $this->CoreTrait_getCoreObject()->isInstanceOf("\Traversable") &&
            (!$this->CoreTrait_getCoreObject()->hasMethod('count') || $object instanceof \Generator)
        ) {
            return iterator_count($object);
        }

        if ($this->CoreTrait_getCoreObject()->hasMethod('count')) {
            return $object->count();
        }

        return count($object);
    }
}
