<?php
/**
 * Shortcode Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Shortcode;

/**
 * Trait ShortcodeTrait
 *
 * @package Devaloka\Component\Shortcode
 */
trait ShortcodeTrait
{
    /**
     * Gets the string representation of the Shortcode.
     *
     * @return string The string representation.
     */
    public function __toString()
    {
        return $this->generate();
    }

    /**
     * Gets the Shortcode tag name.
     *
     * @return string The Shortcode tag name.
     */
    abstract public function getName();

    /**
     * Gets the callable for the Shortcode processing.
     *
     * @return callable The callable.
     */
    public function getCallable()
    {
        return function () {
        };
    }

    /**
     * Gets the default options.
     *
     * @return mixed[] The default options.
     */
    public function getDefaultOptions()
    {
        return [];
    }

    /**
     * Generates the Shortcode string with the given options and content.
     *
     * @param mixed[] $options The options.
     * @param string|null $content The enclosed content.
     *
     * @return string The generated Shortcode string.
     */
    public function generate(array $options = [], $content = null)
    {
        $name       = $this->getName();
        $options    = shortcode_atts($this->getDefaultOptions(), $options, $this->getName());
        $attributes = implode(
            ' ',
            array_map(
                function ($value, $key) {
                    return !is_int($key) ? $key . '="' . $value . '"' : $value;
                },
                $options,
                array_keys($options)
            )
        );

        $shortcode = '[' . trim($name . ' ' . $attributes);

        if ($content === null) {
            $shortcode .= ' /]';
        } else {
            $shortcode .= ']';
            $shortcode .= $content;
            $shortcode .= '[/' . $name . ']';
        }

        return $shortcode;
    }

    /**
     * Invokes the Shortcode.
     *
     * @param mixed[] $options The options.
     * @param string|null $content The enclosed content.
     *
     * @return string The processed content.
     */
    public function invoke(array $options = [], $content = null)
    {
        $shortcode = $this->generate($options, $content);

        return do_shortcode($shortcode);
    }

    /**
     * Registers the Shortcode.
     */
    public function register()
    {
        add_shortcode($this->getName(), $this->getCallable());
    }

    /**
     * Unregisters the Shortcode.
     */
    public function unregister()
    {
        remove_shortcode($this->getName());
    }
}
