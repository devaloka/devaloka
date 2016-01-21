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
            return '';
        };
    }

    /**
     * Gets the default attributes.
     *
     * @return mixed[] The default attributes.
     */
    public function getDefaultAttributes()
    {
        return [];
    }

    /**
     * Generates the Shortcode string with the given attributes and content.
     *
     * @param mixed[] $attributes The attributes.
     * @param string|null $content The enclosed content.
     *
     * @return string The generated Shortcode string.
     */
    public function generate(array $attributes = [], $content = null)
    {
        $name             = $this->getName();
        $attributes       = shortcode_atts($this->getDefaultAttributes(), $attributes, $this->getName());
        $attributesString = implode(
            ' ',
            array_map(
                function ($value, $key) {
                    return !is_int($key) ? $key . '="' . $value . '"' : $value;
                },
                $attributes,
                array_keys($attributes)
            )
        );

        $shortcode = '[' . trim($name . ' ' . $attributesString);

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
     * @param mixed[] $attributes The attributes.
     * @param string|null $content The enclosed content.
     *
     * @return string The processed content.
     */
    public function invoke(array $attributes = [], $content = null)
    {
        $shortcode = $this->generate($attributes, $content);

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
