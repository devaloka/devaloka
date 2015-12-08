<?php
/**
 * Container Aware Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\DependencyInjection;

/**
 * Trait ContainerAwareTrait
 *
 * @package Devaloka\DependencyInjection
 *
 * @codeCoverageIgnore
 */
trait ContainerAwareTrait
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
