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

/**
 * Class NavMenuTrait
 *
 * @package Devaloka\Component\NavMenu
 */
trait NavMenuTrait
{
    /**
     * @return string The menu location identifier.
     */
    abstract public function getLocation();

    /**
     * @return string The menu location descriptive text.
     */
    abstract public function getDescription();

    public function register()
    {
        register_nav_menu($this->getLocation(), $this->getDescription());
    }

    /**
     * @return bool True on success, false on failure.
     */
    public function unregister()
    {
        unregister_nav_menu($this->getLocation());
    }
}
