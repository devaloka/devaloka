<?php
/**
 * Bootable Provider Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Provider;

use Devaloka\Devaloka;
use Devaloka\DependencyInjection\ContainerInterface;

/**
 * Interface BootableProviderInterface
 *
 * @package Devaloka\Provider
 *
 * @codeCoverageIgnore
 */
interface BootableProviderInterface
{
    /**
     * @param Devaloka $devaloka
     * @param ContainerInterface $container
     */
    public function boot(Devaloka $devaloka, ContainerInterface $container);
}
