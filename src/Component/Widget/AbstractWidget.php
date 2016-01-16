<?php
/**
 * Abstract Widget
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
 * Class AbstractWidget
 *
 * @package Devaloka\Component\Widget
 */
abstract class AbstractWidget extends WP_Widget implements WidgetInterface
{
    use WidgetTrait;
}
