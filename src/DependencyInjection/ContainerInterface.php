<?php
/**
 * Container Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\DependencyInjection;

/**
 * Interface ContainerInterface
 *
 * @package Devaloka\DependencyInjection
 *
 * @codeCoverageIgnore
 */
interface ContainerInterface
{
    public function get($id);

    public function has($id);
}
