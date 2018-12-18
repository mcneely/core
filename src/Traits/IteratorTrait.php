<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use Iterator;
use Generator;
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

        return $this
            ->IteratorTrait_unwrap()
            ->key()
            ;
    }

    public function current()
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this
            ->IteratorTrait_unwrap()
            ->current()
            ;
    }

    public function next(): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $this
            ->IteratorTrait_unwrap()
            ->next()
        ;

        return $this;
    }

    public function valid(): bool
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this
            ->IteratorTrait_unwrap()
            ->valid()
            ;
    }

    public function rewind(): self
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $this
            ->IteratorTrait_unwrap()
            ->rewind()
        ;

        return $this;
    }

    protected function IteratorTrait_unwrap(): Iterator
    {
        return $this
            ->CoreTrait_getCoreObject()
            ->unWrap(Iterator::class, Generator::class)
            ->getObject()
            ;
    }
}
