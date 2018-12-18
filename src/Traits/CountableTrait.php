<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use Countable;
use Mcneely\Core\CoreObject;

/**
 * Trait CountableTrait.
 *
 * @package Mcneely\Core\Traits
 *
 * @method CoreObject CoreTrait_getCoreObject()
 * @method mixed fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
 */
trait CountableTrait
{
    /**
     * @return int
     */
    public function count(): int
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        $object = $this
            ->CoreTrait_getCoreObject()
            ->unWrap()
            ->getObject()
        ;

        if ($object instanceof Countable || method_exists($object, 'count')) {
            return $object->count();
        }

        return is_null($object) ? 0 : 1;
    }
}
