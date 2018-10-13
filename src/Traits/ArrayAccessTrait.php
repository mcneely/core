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

        return $this->getObject_ArrayAccessTrait()
                    ->offsetExists($offset);
    }

    public function offsetGet($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->getObject_ArrayAccessTrait()
                    ->offsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->getObject_ArrayAccessTrait()
             ->offsetSet($offset, $value);

        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $this->getObject_ArrayAccessTrait()
             ->offsetUnset($offset);

        return $this;
    }

    private function getObject_ArrayAccessTrait() {
        $object = $this->getCoreObject_CoreTrait()
                    ->getObject();
        return ($object instanceof \Generator) ? iterator_to_array($object) : $object;
    }
}