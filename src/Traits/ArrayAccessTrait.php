<?php

namespace Mcneely\Core\Traits;

/**r
 * Trait ArrayAccessTrait
 *
 * @package Mcneely\Core\Traits
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait ArrayAccessTrait
{
    public function offsetExists($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getCoreObject_CoreTrait()
                    ->getObject()
                    ->offsetExists($offset);
    }

    public function offsetGet($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getCoreObject_CoreTrait()
                    ->getObject()
                    ->offsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->getCoreObject_CoreTrait()
             ->getObject()
             ->offsetSet($offset, $value);

        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->getCoreObject_CoreTrait()
             ->getObject()
             ->offsetUnset($offset);

        return $this;
    }
}