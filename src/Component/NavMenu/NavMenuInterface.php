<?php
/**
 * NavMenu Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\NavMenu;

/**
 * Interface NavMenuInterface
 *
 * @package Devaloka\Component\NavMenu
 *
 * @codeCoverageIgnore
 */
interface NavMenuInterface
{
    /**
     * @return string The menu location identifier.
     */
    public function getLocation();

    /**
     * @return string The menu location descriptive text.
     */
    public function getDescription();

    public function register();

    /**
     * @return bool True on success, false on failure.
     */
    public function unregister();
}
