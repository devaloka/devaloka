<?php
/**
 * Event Listener Provider Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Provider;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;

/**
 * Interface EventListenerProviderInterface
 *
 * @package Devaloka\Provider
 *
 * @codeCoverageIgnore
 */
interface EventListenerProviderInterface
{
    /**
     * @param Devaloka $devaloka
     * @param ContainerInterface $container
     * @param EventDispatcherInterface $dispatcher
     */
    public function subscribe(Devaloka $devaloka, ContainerInterface $container, EventDispatcherInterface $dispatcher);
}
