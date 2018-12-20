<?php

declare(strict_types=1);

namespace Mcneely\Core;

use ArrayIterator;

/**
 * Class CoreObject.
 *
 * @package Mcneely\Core
 */
class CoreObject
{
    /** @var mixed $object */
    protected $object;

    /** @var callable|false $retriever */
    protected $retriever = false;

    /** @var callable|false $boundObject */
    protected $boundObject = false;

    protected $unwrapSkipped = false;

    /**
     * CoreObject constructor.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->setObject($object);
    }

    /**
     * @param callable $retriever
     *
     * @return CoreObject
     */
    public function setRetriever(callable $retriever): self
    {
        $this->retriever = $retriever;

        return $this;
    }

    public function unWrap(?string $instance = null, ?string $exclude = null)
    {
        $object = $this->getUnwrapped($instance, $exclude);

        if ($this->unwrapSkipped) {
            return $object;
        }

        $this->setObject($object);
        $this->retriever = false;

        return $object;
    }

    public function getUnwrapped(?string $instance = null, ?string $exclude = null)
    {
        $object = $this->getObject();

        $object = ($object instanceof \IteratorAggregate) ? $object->getIterator() : $object;
        $object = ($object instanceof \IteratorIterator) ? $object->getInnerIterator() : $object;

        $exclude = ($exclude && $object instanceof $exclude);

        $this->unwrapSkipped = false;
        if ($instance && $object instanceof $instance && !$exclude) {
            $this->unwrapSkipped = true;

            return $object;
        }
        $object = ($object instanceof \Traversable) ? iterator_to_array($object) : $object;
        $object = (method_exists($object, 'toArray')) ? $object->toArray() : $object;
        $object = (is_array($object)) ? new ArrayIterator($object) : $object;

        return $object;
    }

    /**
     * @return mixed
     */
    protected function getObject()
    {
        $this->bindRetriever();

        return ($this->hasRetriever()) ? $this->boundObject : $this->object;
    }

    /**
     * @param mixed $object
     *
     * @return CoreObject
     */
    public function setObject($object): self
    {
        $this->object      = $object;
        $this->boundObject = false;

        return $this;
    }

    /**
     * @param bool|null $rebind
     *
     * @return CoreObject
     */
    public function bindRetriever(?bool $rebind = false): self
    {
        if ($this->hasRetriever() && ($rebind || !$this->boundObject)) {
            $retriever         = $this->retriever;
            $this->boundObject = $retriever($this->object);
        }

        return $this;
    }

    public function hasRetriever(): bool
    {
        return (bool) $this->retriever;
    }
}
