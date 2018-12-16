<?php
declare(strict_types = 1);

namespace Mcneely\Core\Traits;

use ArrayIterator;
use Mcneely\Core\CoreObject;

/**
 * Trait IteratorTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method mixed setCoreObject_CoreTrait($object = null)
 * @method CoreObject CoreTrait_getCoreObject()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait IteratorTrait
{
    public function key(): string
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->CoreTrait_getCoreObject()
                    ->getObject()
                    ->key();
    }

    public function current()
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->CoreTrait_getCoreObject()
                    ->getObject()
                    ->current();
    }

    public function next(): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->CoreTrait_getCoreObject()
             ->getObject()
             ->next();

        return $this;
    }

    public function valid(): bool
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->CoreTrait_getCoreObject()
                    ->getObject()
                    ->valid();
    }

    public function rewind(): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->CoreTrait_getCoreObject()
                       ->getObject();

        if ($this->CoreTrait_getCoreObject()->hasMethod('rewind') && !$object instanceof \Generator) {
            $object->rewind();

            return $this;
        }

        $object = ($object instanceof \Iterator) ? iterator_to_array($object) : (array) $object;
        $object = new ArrayIterator($object);
        $this->CoreTrait_setCoreObject($object);

        return $this;
    }
}
