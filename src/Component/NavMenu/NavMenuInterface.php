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
     * Gets the menu location identifier.
     *
     * @return string The location identifier.
     */
    public function getLocation();

    /**
     * Gets the menu location descriptive text.
     *
     * @return string The location descriptive text.
     */
    public function getDescription();

    /**
     * Renders the menu with the given options.
     *
     * @param mixed[] $options The options.
     *
     * @return string The rendered HTML.
     */
    public function render(array $options = []);

    /**
     * Displays the menu with the given options.
     *
     * @param mixed[] $options The options.
     */
    public function display(array $options = []);

    /**
     * Registers the menu.
     */
    public function register();

    /**
     * Unregisters the menu.
     *
     * @throws \RuntimeException If the menu cannot be unregistered.
     */
    public function unregister();
}
