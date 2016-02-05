<?php
/**
 * TemplatingAwareInterface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Templating;

/**
 * Interface TemplatingAwareInterface
 *
 * @package Devaloka\Component\Templating
 *
 * @codeCoverageIgnore
 */
interface TemplatingAwareInterface
{
    public function setTemplating(TemplatingInterface $templating);
}
