<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use ArrayAccess;
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
    public function offsetExists($offset)
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this
            ->ArrayAccessTrait_unwrap()
            ->offsetExists($offset)
            ;
    }

    public function offsetGet($offset)
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this
            ->ArrayAccessTrait_unwrap()
            ->offsetGet($offset)
            ;
    }

    public function offsetSet($offset, $value)
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $this
            ->ArrayAccessTrait_unwrap()
            ->offsetSet($offset, $value)
        ;

        return $this;
    }

    public function offsetUnset($offset)
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);
        $this
            ->ArrayAccessTrait_unwrap()
            ->offsetUnset($offset)
        ;

        return $this;
    }

    protected function ArrayAccessTrait_unwrap(): ArrayAccess
    {
        return $this
            ->CoreTrait_getCoreObject()
            ->unWrap(ArrayAccess::class)
            ->getObject()
        ;
    }
}
