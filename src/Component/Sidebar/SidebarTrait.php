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
    abstract public function getId();

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
     * Renders the Sidebar with the given options.
     *
     * @return string The rendered HTML.
     */
    public function render()
    {
        $sidebarId = $this->getId();

        if (!is_active_sidebar($sidebarId)) {
            return '';
        }

        ob_start();

        dynamic_sidebar($sidebarId);

        return ob_get_clean();
    }

    /**
     * Displays the Sidebar with the given options.
     */
    public function display()
    {
        echo $this->render();
    }

    /**
     * Registers the Sidebar.
     *
     * @return string The Sidebar ID.
     */
    public function register()
    {
        $args = array_merge($this->getOptions(), ['id' => $this->getId()]);

        register_sidebar($args);
    }

    /**
     * Unregisters the Sidebar.
     */
    public function unregister()
    {
        unregister_sidebar($this->getId());
    }
}
