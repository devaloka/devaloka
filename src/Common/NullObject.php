<?php
/**
 * Null Object
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Common;

/**
 * Class NullObject
 *
 * @package Devaloka\Common
 */
class NullObject implements \ArrayAccess, \Countable, \Iterator, \Serializable, \JsonSerializable
{
    public function __construct()
    {
    }

    public static function __callStatic($name, $arguments)
    {
    }

    public function __invoke()
    {
        return $this;
    }

    public function __call($name, $arguments)
    {
        return $this;
    }

    public function __get($arg)
    {
        return $this;
    }

    public function __toString()
    {
        return (string) null;
    }

    public function __clone()
    {
    }

    public function __sleep()
    {
        return [];
    }

    public function __wakeup()
    {
        return $this;
    }

    public function serialize()
    {
        return serialize(null);
    }

    public function unserialize($serialized)
    {
        return null;
    }

    public function jsonSerialize()
    {
        return new \stdClass();
    }

    public function current()
    {
        return $this;
    }

    public function next()
    {
    }

    public function key()
    {
        return $this;
    }

    public function valid()
    {
        return false;
    }

    public function rewind()
    {
    }

    public function offsetExists($offset)
    {
        return false;
    }

    public function offsetGet($offset)
    {
        return $this;
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
    }

    public function count()
    {
        return 0;
    }
}
