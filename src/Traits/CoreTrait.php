<?php

namespace Mcneely\Core\Traits;

use Mcneely\Core\CoreObject;

trait CoreTrait
{
    /** @var CoreObject */
    private $CoreTrait_CoreObject = null;
    /** @var bool $CoreTrait_hasSetUp */
    private $CoreTrait_hasSetUp = false;
    /** @var array $coreTrait_events */
    private $coreTrait_events = [];

    /**
     * @return CoreObject
     */
    protected function getCoreObject_CoreTrait()
    {
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->CoreTrait_CoreObject;
    }

    /**
     * @param mixed $object
     *
     * @return $this
     */
    protected function setCoreObject_CoreTrait($object = null)
    {
        $this->CoreTrait_CoreObject = new CoreObject($object);
        $this->fireEvents_CoreTrait($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this;
    }

    /**
     * @param object|false $eventClassObject
     * @param object|false $eventImmediateClass
     * @param object|false $eventMethod
     * @param object|false $eventTrait
     *
     * @return $this
     */
    protected function fireEvents_CoreTrait($eventClassObject, $eventImmediateClass, $eventMethod, $eventTrait)
    {
        if (!$this->CoreTrait_hasSetUp) {
            $this->CoreTrait_hasSetUp = true;
            $traits                   = array_merge(class_uses($eventImmediateClass), class_uses($eventClassObject));
            foreach ($traits as $key => $trait) {
                $traits[$key] = basename(str_replace('\\', '/', $trait));
            }

            $methods = preg_grep('/^__setUp_/', get_class_methods(get_class($eventClassObject)));

            foreach ($methods as $method) {
                if (in_array(substr($method, 8), $traits)) {
                    $eventClassObject->$method();
                }
            }
        }

        $eventMethodArray = explode('::', $eventMethod);
        $eventMethodShort = array_pop($eventMethodArray);
        $beforeMethod     = "__fireBefore_".$eventMethodShort;
        $triggers         = [];

        if (method_exists($eventClassObject, $beforeMethod)) {
            $triggers[] = [
                'method'  => $beforeMethod,
                'exclude' => [],
            ];
        }

        $functionTriggers = array_key_exists(
            $eventMethodShort,
            $this->coreTrait_events
        ) ? $this->coreTrait_events[$eventMethodShort] : [];
        $wildCardTriggers = array_key_exists('*', $this->coreTrait_events) ? $this->coreTrait_events['*'] : [];
        $triggers         = array_merge($triggers, $functionTriggers, $wildCardTriggers);

        foreach ($triggers as $trigger) {
            if (!in_array($eventMethodShort, $trigger['exclude'])) {
                $method = $trigger['method'];
                if ($method instanceof \Closure) {
                    $closure = \Closure::bind($method, $eventClassObject);
                    $closure();
                } else {
                    $eventClassObject->$method();
                }
            }
        }

        return $this;
    }

    protected function registerEvent_CoreTrait($onFunction, $triggerMethod, array $exclude = [])
    {
        $this->coreTrait_events[$onFunction][] = [
            'method'  => $triggerMethod,
            'exclude' => ($onFunction === '*') ? $exclude : [],
        ];

        return $this;
    }
}