<?php
/**
 * Sidebar Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Sidebar;

/**
 * Interface SidebarInterface
 *
 * @package Devaloka\Component\Sidebar
 *
 * @codeCoverageIgnore
 */
interface SidebarInterface
{
    /**
     * Gets the Sidebar ID.
     *
     * @return string The Sidebar ID.
     */
    public function getId();

    /**
     * Gets the Sidebar options.
     *
     * @return mixed[] The options.
     */
    public function getOptions();

    /**
     * Renders the Sidebar.
     *
     *
     * @return string The rendered HTML.
     */
    public function render();

    /**
     * Displays the Sidebar.
     */
    public function display();

    /**
     * Registers the Sidebar.
     */
    public function register();

    /**
     * Unregisters the Sidebar.
     */
    public function unregister();
}
