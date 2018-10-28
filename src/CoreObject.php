<?php

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

    /** @var callable|false */
    protected $retriever = false;

    /**
     * CoreObject constructor.
     *
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @param callable $retriever
     *
     * @return CoreObject
     */
    public function setRetriever(callable $retriever)
    {
        $this->retriever = $retriever;

        return $this;
    }

    public function hasRetriever()
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
        $retriever = $this->retriever;

        return ($retriever && $useRetriever) ? $retriever($this->object) : $this->object;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return get_class($this->object);
    }

    /**
     * @param string $instance
     *
     * @return bool
     */
    public function isInstanceOf($instance)
    {
        return $this->object instanceof $instance;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function hasMethod($method)
    {
        return method_exists($this->object, $method);
    }

    public function isArray()
    {
        return is_array($this->object);
    }
}
