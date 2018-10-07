<?php

namespace Mcneely\Core\Traits;

/**
 * Trait IteratorTrait
 *
 * @package Mcneely\Core\Traits
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $event)
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

        $this->getCoreObject_CoreTrait()
             ->getObject()
             ->rewind();

        return $this;
    }
}