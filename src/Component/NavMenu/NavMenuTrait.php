<?php
/**
 * NavMenu Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\NavMenu;

use RuntimeException;

/**
 * Class NavMenuTrait
 *
 * @package Devaloka\Component\NavMenu
 */
trait NavMenuTrait
{
    /**
     * Gets the menu location identifier.
     *
     * @return string The location identifier.
     */
    abstract public function getLocation();

    /**
     * Gets the menu location descriptive text.
     *
     * @return string The location descriptive text.
     */
    abstract public function getDescription();

    /**
     * Gets the default options for the menu.
     *
     * @return mixed[] The default options.
     */
    public function getDefaultOptions()
    {
        return [];
    }

    /**
     * Registers the menu.
     */
    public function register()
    {
        register_nav_menu($this->getLocation(), $this->getDescription());
    }

    /**
     * Unregisters the menu.
     *
     * @throws RuntimeException If the menu cannot be unregistered.
     */
    public function unregister()
    {
        if (!unregister_nav_menu($this->getLocation())) {
            throw new RuntimeException('Cannot unregister the NavMenu.');
        }
    }
}
