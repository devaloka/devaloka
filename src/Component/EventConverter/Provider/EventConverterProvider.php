<?php
/**
 * Event Converter Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\EventConverter\Provider;

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Provider\ServiceProviderInterface;
use Devaloka\Provider\EventListenerProviderInterface;

/**
 * Class EventConverterProvider
 *
 * @package Devaloka\Component\EventConverter\Provider
 */
class EventConverterProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('event_converter.class', 'Devaloka\\EventConverter\\EventConverter');

        $container->add(
            'event_converter',
            function (Container $container) {
                return new $container['event_converter.class']($container['event_dispatcher']);
            }
        );

        $container->add(
            'event_converter.converter_listener.class',
            'Devaloka\\EventConverter\\EventListener\\EventConverterListener'
        );

        $container->add(
            'event_converter.converter_listener',
            function (Container $container) {
                return new $container['event_converter.converter_listener.class']($container['event_converter']);
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function subscribe(Devaloka $devaloka, ContainerInterface $container, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addSubscriber($container->get('event_converter.converter_listener'));
    }
}
