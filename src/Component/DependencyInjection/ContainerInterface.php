<?php
/**
 * Container Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\DependencyInjection;

/**
 * Interface ContainerInterface
 *
 * @package Devaloka\Component\DependencyInjection
 *
 * @codeCoverageIgnore
 */
interface ContainerInterface
{
    public function get($id);

    public function has($id);
}
