<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use ArrayIterator;
use Mcneely\Core\CoreObject;

/**
 * Trait ArrayAccessTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method mixed setCoreObject_CoreTrait()
 * @method CoreObject CoreTrait_getCoreObject()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait ArrayAccessTrait
{
    public function offsetExists(string $offset): bool
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->ArrayAccessTrait_unwrap();

        return $object->offsetExists($offset);
    }

    public function offsetGet(string $offset)
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->ArrayAccessTrait_unwrap();

        return $object->offsetGet($offset);
    }

    public function offsetSet(string $offset, $value): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->ArrayAccessTrait_unwrap(true);
        $object->offsetSet($offset, $value);

        return $this;
    }

    public function offsetUnset(string $offset): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);
        $object = $this->ArrayAccessTrait_unwrap(true);
        $object->offsetUnset($offset);

        return $this;
    }

    protected function ArrayAccessTrait_unwrap(?bool $update = false): ArrayIterator
    {
        $coreObject = $this->CoreTrait_getCoreObject();
        $object     = $coreObject->getObject(true);
        $object     = ($object instanceof \IteratorAggregate) ? $object->getIterator() : $object;
        $object     = ($object instanceof \IteratorIterator) ? $object->getInnerIterator() : $object;
        $object     = ($object instanceof \Iterator) ? iterator_to_array($object) : (array) $object;
        $object     = new ArrayIterator($object);

        if ($update) {
            $coreObject->setObject($object);
        }

        return $object;
    }
}
