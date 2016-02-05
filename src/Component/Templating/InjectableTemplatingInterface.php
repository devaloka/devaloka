<?php
/**
 * Injectable Templating Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Templating;

/**
 * Interface InjectableTemplatingInterface
 *
 * @package Devaloka\Component\Templating
 *
 * @codeCoverageIgnore
 */
interface InjectableTemplatingInterface extends TemplatingInterface
{
    public function injectGlobals();
}
