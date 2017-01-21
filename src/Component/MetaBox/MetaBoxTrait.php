<?php
/**
 * MetaBox Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2017 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\MetaBox;

use WP_Post;

/**
 * Trait MetaBoxTrait
 *
 * @package Devaloka\Component\MetaBox
 */
trait MetaBoxTrait
{
    /**
     * Gets the meta box name.
     *
     * @return string The Shortcode tag name.
     */
    abstract public function getName();

    /**
     * Gets the meta box title.
     *
     * @return string The Shortcode tag name.
     */
    abstract public function getTitle();

    /**
     * Displays the meta box.
     *
     * @param WP_Post $post A post which the meta box should be displayed for.
     */
    public function display(WP_Post $post)
    {
        echo $this->render($post);
    }

    /**
     * Renders the meta box.
     *
     * @param WP_Post $post A post which the meta box should be rendered for.
     *
     * @return string The content of the meta box.
     */
    public function render(WP_Post $post)
    {
        return '';
    }
}
