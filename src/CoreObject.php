<?php
declare(strict_types = 1);

namespace Mcneely\Core;

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

    public function hasRetriever(): bool
    {
        return (bool) $this->retriever;
    }

    /**
     * @param bool $useRetriever
     *
     * @return mixed
     */
    public function getObject($useRetriever = true)
    {
        if (!$this->boundObject && $this->hasRetriever()) {
            $retriever = $this->retriever;
            $this->boundObject =  $retriever($this->object);
        }

        return ($this->hasRetriever() && $useRetriever) ? $this->boundObject : $this->object;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return get_class($this->object);
    }

    /**
     * @param string $instance
     *
     * @return bool
     */
    public function isInstanceOf($instance): bool
    {
        return $this->object instanceof $instance;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function hasMethod($method): bool
    {
        return method_exists($this->object, $method);
    }

    public function isArray(): bool
    {
        return is_array($this->object);
    }

    /**
     * @param mixed $object
     * @return CoreObject
     */
    public function setObject($object): self
    {
        $this->object = $object;
        $this->boundObject = false;

        return $this;
    }


}
