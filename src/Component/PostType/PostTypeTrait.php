<?php
/**
 * PostType Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\PostType;

use RuntimeException;

/**
 * Trait PostTypeTrait
 *
 * @package Devaloka\Component\PostType
 */
trait PostTypeTrait
{
    /**
     * Gets the Post Type name.
     *
     * @return string The Post Type name.
     */
    abstract public function getName();

    /**
     * Gets the Post Type options.
     *
     * @return mixed[] The options.
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Registers the Post Type.
     *
     * @throws RuntimeException If the Post Type cannot be registered.
     */
    public function register()
    {
        if (is_wp_error(register_post_type($this->getName(), $this->getOptions()))) {
            throw new RuntimeException('Cannot register the Post Type.');
        }
    }

    /**
     * Unregisters the menu.
     *
     * @throws RuntimeException If the Post Type cannot be unregistered.
     *
     * @see https://core.trac.wordpress.org/ticket/14761 #14761 (unregister_post_type()) – WordPress Trac
     */
    public function unregister()
    {
        // Introduced since WordPress 4.5.
        if (!$this->supportsUnregistration() || is_wp_error(unregister_post_type($this->getName()))) {
            throw new RuntimeException('Cannot unregister the Post Type.');
        }
    }

    /**
     * Returns whether unregistration is supported.
     *
     * @return bool True if unregistration is supported, false otherwise.
     */
    protected function supportsUnregistration()
    {
        return function_exists('unregister_post_type');
    }
}
