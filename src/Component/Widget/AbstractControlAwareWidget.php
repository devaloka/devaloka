<?php
/**
 * Abstract Control Aware Widget
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Widget;

use WP_Widget;

/**
 * Class AbstractControlAwareWidget
 *
 * @package Devaloka\Component\Widget
 */
abstract class AbstractControlAwareWidget extends WP_Widget implements ControlAwareWidgetInterface
{
    use ControlAwareWidgetTrait;
}
