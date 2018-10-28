<?php

namespace Mcneely\Core\Traits;

use ArrayIterator;

/**
 * Trait ArrayAccessTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed setCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait ArrayAccessTrait
{
    public function offsetExists($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->unwrap_ArrayAccessTrait();

        return $object->offsetExists($offset);
    }

    public function offsetGet($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->unwrap_ArrayAccessTrait();

        return $object->offsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->unwrap_ArrayAccessTrait();
        $object->offsetSet($offset, $value);

        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->unwrap_ArrayAccessTrait();
        $object->offsetUnset($offset);

        return $this;
    }

    protected function unwrap_ArrayAccessTrait()
    {
        $object = $this->getCoreObject_CoreTrait()->getObject(false);
        $object = ($object instanceof \IteratorAggregate) ? $object->getIterator() : $object;
        $object = ($object instanceof \IteratorIterator) ? $object->getInnerIterator() : $object;
        $object = ($object instanceof \Iterator) ? iterator_to_array($object) : (array) $object;
        $object = new ArrayIterator($object);
        $this->setCoreObject_CoreTrait($object);

        return $object;
    }
}
