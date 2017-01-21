<?php
/**
 * MetaBox Interface
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
 * Interface MetaBoxInterface
 *
 * @package Devaloka\Component\MetaBox
 *
 * @codeCoverageIgnore
 */
interface MetaBoxInterface
{
    /**
     * Gets the meta box name.
     *
     * @return string The Shortcode tag name.
     */
    public function getName();

    /**
     * Gets the meta box title.
     *
     * @return string The Shortcode tag name.
     */
    public function getTitle();

    /**
     * Displays the meta box.
     *
     * @param WP_Post $post A post which the meta box should be displayed for.
     */
    public function display(WP_Post $post);

    /**
     * Renders the meta box.
     *
     * @param WP_Post $post A post which the meta box should be rendered for.
     *
     * @return string The content of the meta box.
     */
    public function render(WP_Post $post);
}
