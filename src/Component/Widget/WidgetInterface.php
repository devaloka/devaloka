<?php
/**
 * Widget Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Widget;

/**
 * Interface WidgetInterface
 *
 * @package Devaloka\Component\Widget
 *
 * @codeCoverageIgnore
 */
interface WidgetInterface
{
    /**
     * Gets the Widget name.
     *
     * @return string The Widget name.
     */
    public function getName();

    /**
     * Gets the Widget options.
     *
     * @return mixed[] The options.
     */
    public function getOptions();

    /**
     * Renders a Widget.
     *
     * @param mixed[] $args The Widget arguments for output including `before_title`, `after_title`, `before_widget`,
     *                      and `after_widget`.
     * @param mixed[] $instance The instance-specific Widget settings.
     *
     * @return string The rendered HTML.
     */
    public function render(array $args, array $instance);

    /**
     * Displays a Widget.
     *
     * @param mixed[] $args The Widget arguments for output including `before_title`, `after_title`, `before_widget`,
     *                      and `after_widget`.
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function display(array $args, array $instance);
}
