<?php
/**
 * PostType Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\PostType;

/**
 * Interface PostTypeInterface
 *
 * @package Devaloka\Component\PostType
 *
 * @codeCoverageIgnore
 */
interface PostTypeInterface
{
    /**
     * Gets the Post Type name.
     *
     * @return string The Post Type name.
     */
    public function getName();

    /**
     * Gets the Post Type options.
     *
     * @return mixed[] The options.
     */
    public function getOptions();

    /**
     * Registers the Post Type.
     *
     * @throws \RuntimeException If the Post Type cannot be registered.
     */
    public function register();

    /**
     * Unregisters the Post Type.
     *
     * @throws \RuntimeException If the Post Type cannot be unregistered.
     */
    public function unregister();
}
