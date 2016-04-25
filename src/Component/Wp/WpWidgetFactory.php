<?php
/**
 * WP Widget Factory
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Wp;

use ReflectionClass;
use WP_Widget_Factory;
use Devaloka\Component\DependencyInjection\ContainerAwareTrait;
use Devaloka\Component\DependencyInjection\ContainerAwareInterface;
use Devaloka\Provider\EventListenerProviderInterface;

/**
 * Class WpWidgetFactory
 *
 * @package Devaloka\Component\Wp
 */
class WpWidgetFactory extends WP_Widget_Factory implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function register($widgetClass)
    {
        $arguments = array_slice(func_get_args(), 1);
        $class     = new ReflectionClass($widgetClass);
        $widget    = $class->newInstanceArgs($arguments);

        if ($widget instanceof ContainerAwareInterface) {
            $widget->setContainer($this->container);
        }

        if ($widget instanceof EventListenerProviderInterface) {
            $widget->subscribe(
                $this->container->get('devaloka'),
                $this->container->get('container'),
                $this->container->get('event_dispatcher')
            );
        }

        $this->widgets[$widgetClass] = $widget;

        return $widget;
    }
}
