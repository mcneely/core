<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 9/23/18
 * Time: 5:53 PM
 */

namespace Mcneely\Core\Traits;

/**
 * Trait JsonSerializableTrait
 *
 * @package Mcneely\Core\Traits
 * @method \Mcneely\Core\CoreObject getCoreObject_CoreTrait()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait JsonSerializableTrait
{
    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this->getCoreObject_CoreTrait()
                       ->getObject();

        if ($this->getCoreObject_CoreTrait()->isArray()) {
            return $object;
        }

        if ($this->getCoreObject_CoreTrait()->hasMethod('toArray')) {
            return $object->toArray();
        }

        if ($this->getCoreObject_CoreTrait()->isInstanceOf("\Traversable")) {
            return iterator_to_array($object);
        }
    }
}