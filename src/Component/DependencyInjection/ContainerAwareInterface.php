<?php
/**
 * Container Aware Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\DependencyInjection;

/**
 * Interface ContainerAwareInterface
 *
 * @package Devaloka\Component\DependencyInjection
 *
 * @codeCoverageIgnore
 */
interface ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null);
}
