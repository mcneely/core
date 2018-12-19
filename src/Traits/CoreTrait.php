<?php

declare(strict_types=1);

namespace Mcneely\Core\Traits;

use Mcneely\Core\CoreObject;

trait CoreTrait
{
    /** @var CoreObject */
    private $CoreTrait_CoreObject = null;

    /** @var bool $CoreTrait_hasSetUp */
    private $CoreTrait_hasSetUp = false;

    /** @var array $CoreTrait_events */
    private $CoreTrait_events = [];

    /**
     * @return CoreObject
     */
    protected function CoreTrait_getCoreObject(): CoreObject
    {
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this->CoreTrait_CoreObject;
    }

    /**
     * @param object $eventClassObject    -- object as function type not introduced until 7.2
     * @param string $eventImmediateClass
     * @param string $eventMethod
     * @param string $eventTrait
     *
     * @return self
     */
    protected function CoreTrait_fireEvents(
        $eventClassObject,
        ?string $eventImmediateClass = '',
        ?string $eventMethod = '',
        ?string $eventTrait = ''
    ): self {
        if (!$this->CoreTrait_hasSetUp) {
            $this->CoreTrait_fireStartup($eventClassObject, $eventImmediateClass);
        }

        $eventMethodArray = !empty($eventMethod) ? explode('::', $eventMethod) : [];
        $eventMethodShort = array_pop($eventMethodArray);
        $beforeMethod     = '__fireBefore_'.$eventMethodShort;
        $triggers         = [];

        if (method_exists($eventClassObject, $beforeMethod)) {
            $triggers[] = [
                'method'  => $beforeMethod,
                'exclude' => [],
            ];
        }

        $functionTriggers = array_key_exists(
            $eventMethodShort,
            $this->CoreTrait_events
        ) ? $this->CoreTrait_events[$eventMethodShort] : [];
        $wildCardTriggers = array_key_exists('*', $this->CoreTrait_events) ? $this->CoreTrait_events['*'] : [];
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

    /**
     * @param object $eventClassObject
     * @param string $eventImmediateClass
     */
    private function CoreTrait_fireStartup($eventClassObject, $eventImmediateClass): void
    {
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

    /**
     * @param mixed $object
     *
     * @return self
     */
    protected function CoreTrait_setCoreObject($object = null): self
    {
        $this->CoreTrait_hasSetUp   = false;
        $this->CoreTrait_events     = [];
        $this->CoreTrait_CoreObject = new CoreObject($object);
        $this->CoreTrait_fireEvents($this, __CLASS__, __METHOD__, __TRAIT__);

        return $this;
    }

    protected function CoreTrait_registerEvent($onFunction, $triggerMethod, array $exclude = []): self
    {
        $this->CoreTrait_events[$onFunction][] = [
            'method'  => $triggerMethod,
            'exclude' => ('*' === $onFunction) ? $exclude : [],
        ];

        return $this;
    }
}
