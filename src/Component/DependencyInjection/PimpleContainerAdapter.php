<?php
/**
 * Pimple Container Adapter
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\DependencyInjection;

use Pimple\Container;

/**
 * Class PimpleContainerAdapter
 *
 * @package Devaloka\Component\DependencyInjection
 *
 * @codeCoverageIgnore
 */
class PimpleContainerAdapter implements ContainerInterface
{
    /**
     * The constructor.
     *
     * @param Container $pimple An instance of Pimple Container.
     */
    public function __construct(Container $pimple)
    {
        $this->pimple = $pimple;
    }

    /**
     * Gets an entry of the container by its ID.
     *
     * @param string $id The ID.
     *
     * @return mixed The entry.
     */
    public function get($id)
    {
        return $this->pimple[$id];
    }

    /**
     * Returns whether the container has an entry for the given ID.
     *
     * @param string $id The ID.
     *
     * @return bool True if the container has the entry for the ID, false otherwise.
     */
    public function has($id)
    {
        return isset($this->pimple[$id]);
    }

    /**
     * Adds an entry to the container for the given ID.
     *
     * @param string $id The ID.
     * @param mixed $value The entry to add.
     */
    public function add($id, $value)
    {
        $this->pimple[$id] = $value;
    }

    /**
     * Extends an entry of the container for the given ID.
     *
     * @param string $id The ID.
     * @param callable $value The callable to extend the original entry.
     *
     * @return callable The wrapped entry.
     */
    public function extend($id, $value)
    {
        return $this->pimple->extend($id, $value);
    }

    /**
     * Makes an entry as being a factory.
     *
     * @param callable $value A callable to be used as the factory.
     *
     * @return callable The factory.
     */
    public function factory($value)
    {
        return $this->pimple->factory($value);
    }

    /**
     * Protects an entry from being evaluated.
     *
     * @param callable $value A callable to be protect from being evaluated.
     *
     * @return callable The passed callable.
     */
    public function protect($value)
    {
        return $this->pimple->protect($value);
    }
}
