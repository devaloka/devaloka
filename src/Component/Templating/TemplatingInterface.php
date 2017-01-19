<?php
/**
 * Templating Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Templating;

/**
 * Interface TemplatingInterface
 *
 * @package Devaloka\Component\Templating
 *
 * @codeCoverageIgnore
 */
interface TemplatingInterface
{
    public function partial($slug, $name = '', array $vars = []);

    public function partialOnly($slug, $name = '', array $vars = []);
}
