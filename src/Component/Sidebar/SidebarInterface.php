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
     * @return string
     */
    public function getId();

    /**
     * @return mixed[]
     */
    public function getOptions();

    /**
     * @return string The Sidebar ID.
     */
    public function register();

    public function unregister();
}
