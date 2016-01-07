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
     * Outputs Widget.
     *
     * @param mixed[] $args The Widget arguments for output.
     * @param mixed[] $instance The instance-specific Widget settings.
     */
    public function widget($args, $instance);
}
