<?php
/**
 * Shortcode Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Shortcode;

/**
 * Interface ShortcodeInterface
 *
 * @package Devaloka\Component\Shortcode
 *
 * @codeCoverageIgnore
 */
interface ShortcodeInterface
{
    /**
     * Gets the Shortcode tag name.
     *
     * @return string The Shortcode tag name.
     */
    public function getName();

    /**
     * Gets the callable for the Shortcode processing.
     *
     * @return callable The callable.
     */
    public function getCallable();

    /**
     * Invokes the Shortcode.
     *
     * @param mixed[] $options The options.
     * @param string|null $content The enclosed content.
     *
     * @return string The processed content.
     */
    public function invoke(array $options = [], $content = null);

    /**
     * Registers the Shortcode.
     */
    public function register();

    /**
     * Unregisters the Shortcode.
     */
    public function unregister();
}
