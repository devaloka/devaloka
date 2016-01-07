<?php
/**
 * Sidebar Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Sidebar;

/**
 * Trait SidebarTrait
 *
 * @package Devaloka\Component\Sidebar
 *
 * @codeCoverageIgnore
 */
trait SidebarTrait
{
    /**
     * Gets the Sidebar ID.
     *
     * @return string The Sidebar ID.
     */
    public function getId()
    {
        $sidebars = array_key_exists('wp_registered_sidebars', $GLOBALS) ? $GLOBALS['wp_registered_sidebars'] : [];
        $nextId   = count($sidebars) + 1;

        return 'sidebar-' . $nextId;
    }

    /**
     * Gets the Sidebar options.
     *
     * @return mixed[] The options.
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Registers the Sidebar.
     *
     * @return string The Sidebar ID.
     */
    public function register()
    {
        $args = array_merge($this->getOptions(), ['id' => $this->getId()]);

        return register_sidebar($args);
    }

    /**
     * Unregisters the Sidebar.
     */
    public function unregister()
    {
        unregister_sidebar($this->getId());
    }
}
