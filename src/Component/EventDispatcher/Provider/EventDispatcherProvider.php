<?php
/**
 * Event Dispatcher Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\EventDispatcher\Provider;

use Pimple\Container;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Provider\ServiceProviderInterface;

/**
 * Class EventDispatcherProvider
 *
 * @package Devaloka\Component\EventDispatcher\Provider
 */
class EventDispatcherProvider implements ServiceProviderInterface
{
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('event_dispatcher.class', 'Devaloka\\Component\\EventDispatcher\\EventDispatcher');
        $container->add(
            'event_dispatcher',
            function (Container $container) {
                return new $container['event_dispatcher.class']();
            }
        );
    }
}
