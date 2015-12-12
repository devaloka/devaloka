<?php
/**
 * Event Dispatcher Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\EventDispatcher\Provider;

use Pimple\Container;
use Devaloka\Devaloka;
use Devaloka\DependencyInjection\ContainerInterface;
use Devaloka\Provider\ServiceProviderInterface;

/**
 * Class EventDispatcherProvider
 *
 * @package Devaloka\EventDispatcher\Provider
 */
class EventDispatcherProvider implements ServiceProviderInterface
{
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('event_dispatcher.class', 'Devaloka\\EventDispatcher\\EventDispatcher');
        $container->add(
            'event_dispatcher',
            function (Container $container) {
                return new $container['event_dispatcher.class']();
            }
        );
    }
}
