<?php

namespace Mcneely\Core;

/**
 * Class CoreObject
 *
 * @package Mcneely\Core
 */
class CoreObject
{
    /** @var mixed $object */
    protected $object;

    /** @var callable */
    protected $retriever;

    /**
     * CoreObject constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;

        $this->setRetriever(
            function ($object) {
                return $object;
            }
        );
    }

    /**
     * @param callable $retriever
     *
     * @return CoreObject
     */
    public function setRetriever($retriever)
    {
        $this->retriever = $retriever;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        $retriever = $this->retriever;

        return $retriever($this->object);
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
     * @return boolean
     */
    public function isInstanceOf($instance)
    {
        return ($this->object instanceof $instance);
    }

    /**
     * @param string $method
     *
     * @return boolean
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