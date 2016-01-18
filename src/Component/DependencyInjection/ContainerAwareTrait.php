<?php
/**
 * Container Aware Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\DependencyInjection;

/**
 * Trait ContainerAwareTrait
 *
 * @package Devaloka\Component\DependencyInjection
 *
 * @codeCoverageIgnore
 */
trait ContainerAwareTrait
{
    /**
     * @var ContainerInterface An instance of ContainerInterface.
     */
    protected $container;

    /**
     * Sets an instance of ContainerInterface.
     *
     * @param ContainerInterface|null $container The ContainerInterface.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
