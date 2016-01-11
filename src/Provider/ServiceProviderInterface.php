<?php
/**
 * Service Provider Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Provider;

use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;

/**
 * Interface ServiceProviderInterface
 *
 * @package Devaloka\Provider
 *
 * @codeCoverageIgnore
 */
interface ServiceProviderInterface
{
    /**
     * @param Devaloka $devaloka
     * @param ContainerInterface $container
     */
    public function register(Devaloka $devaloka, ContainerInterface $container);
}
