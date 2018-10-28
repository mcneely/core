<?php

namespace Mcneely\Core\Traits;

use ArrayIterator;

/**
 * Trait IteratorTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $event)
 * @method mixed setCoreObject_CoreTrait($object = null)
 */
trait IteratorTrait
{
    public function key()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getCoreObject_CoreTrait()
                    ->getObject()
                    ->key();
    }

    public function current()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getCoreObject_CoreTrait()
                    ->getObject()
                    ->current();
    }

    public function next()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->getCoreObject_CoreTrait()
             ->getObject()
             ->next();

        return $this;
    }

    public function valid()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getCoreObject_CoreTrait()
                    ->getObject()
                    ->valid();
    }

    public function rewind()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->getCoreObject_CoreTrait()
                       ->getObject();

        if ($this->getCoreObject_CoreTrait()->hasMethod('rewind') && !$object instanceof \Generator) {
            $object->rewind();
        }

        $object = ($object instanceof \Iterator) ? iterator_to_array($object) : (array) $object;
        $object = new ArrayIterator($object);
        $this->setCoreObject_CoreTrait($object);

        return $this;
    }
}
