<?php

namespace Mcneely\Core\Traits;

/**
 * Trait CountableTrait
 *
 * @package Mcneely\Core\Traits
 * @method  \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $event)
 */
trait CountableTrait
{
    /**
     * @return int
     */
    public function count()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->getCoreObject_CoreTrait()
                       ->getObject();

        if ($this->getCoreObject_CoreTrait()->hasMethod('count')) {
            return $object->count();
        }

        if ($this->getCoreObject_CoreTrait()->isInstanceOf("\Traversable")) {
            return iterator_count($object);
        }

        return count($object);
    }
}