<?php
/**
 * Templating Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Templating\Provider;

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Provider\ServiceProviderInterface;
use Devaloka\Provider\EventListenerProviderInterface;
use Devaloka\Component\EventDispatcher\EventDispatcherAwareInterface;

/**
 * Class TemplatingProvider
 *
 * @package Devaloka\Templating\Provider
 */
class TemplatingProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        // Templating
        $container->add('templating.class', 'Devaloka\\Templating\\Templating');
        $container->add(
            'templating',
            function (Container $container) {
                $templating = new $container['templating.class']();

                return $templating;
            }
        );

        // Event Listener
        $container->add(
            'templating.templating_listener.class',
            'Devaloka\\Templating\\EventListener\\TemplatingListener'
        );
        $container->add(
            'templating.templating_listener',
            function (Container $container) {
                $templating = $container['templating'];
                $listener   = new $container['templating.templating_listener.class']($templating);

                if ($listener instanceof EventDispatcherAwareInterface) {
                    $listener->setEventDispatcher($container['event_dispatcher']);
                }

                return $listener;
            }
        );
    }

    public function subscribe(Devaloka $devaloka, ContainerInterface $container, EventDispatcherInterface $dispatcher)
    {
        $listener = $container->get('templating.templating_listener');

        $dispatcher->addSubscriber($listener);
    }
}
