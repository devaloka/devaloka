<?php
/**
 * Container Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\DependencyInjection;

/**
 * Interface ContainerInterface
 *
 * @package Devaloka\Component\DependencyInjection
 *
 * @codeCoverageIgnore
 */
interface ContainerInterface
{
    /**
     * Gets an entry of the container by its ID.
     *
     * @param string $id The ID.
     *
     * @return mixed The entry.
     */
    public function get($id);

    /**
     * Returns whether the container has an entry for the given ID.
     *
     * @param string $id The ID.
     *
     * @return bool True if the container has the entry for the ID, false otherwise.
     */
    public function has($id);
}
