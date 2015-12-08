<?php
/**
 * Event Dispatcher
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\EventDispatcher;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Devaloka\EventDispatcher\Event\WordPressEvent;

/**
 * Class EventDispatcher
 *
 * @package Devaloka\EventDispatcher
 */
class EventDispatcher implements EventDispatcherInterface
{
    /**
     * {@inheritDoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        if ($event === null || !$event instanceof WordPressEvent) {
            $event = new WordPressEvent();
        }

        $event->setDispatcher($this);
        $event->setName($eventName);

        if (!$this->hasListeners($eventName)) {
            if ($event->hasParameter(0)) {
                $event->setReturnValue($event->getParameter(0));
            }

            return $event;
        }

        $event = $this->doDispatch($eventName, $event);

        return $event;
    }

    public function hasListeners($eventName = null)
    {
        return (bool) $this->getListeners($eventName);
    }

    public function getListeners($eventName = null)
    {
        $listeners = [];

        if (!isset($GLOBALS['wp_filter'])) {
            return $listeners;
        }

        if ($eventName !== null && !isset($GLOBALS['wp_filter'][$eventName])) {
            return $listeners;
        }

        $filters = ($eventName !== null) ? [$eventName => $GLOBALS['wp_filter'][$eventName]] : $GLOBALS['wp_filter'];

        foreach ($filters as $tag => $priorities) {
            foreach ($priorities as $priority => $indices) {
                foreach ($indices as $index => $value) {
                    $listeners[$priority] = $value['function'];
                }
            }
        }

        return $listeners;
    }

    protected function doDispatch($eventName, Event $event)
    {
        if (!isset($GLOBALS['wp_actions']) || !isset($GLOBALS['wp_actions'][$eventName])) {
            $GLOBALS['wp_actions'][$eventName] = 1;
        } else {
            ++ $GLOBALS['wp_actions'][$eventName];
        }

        $result = apply_filters($eventName, $event);

        if (!$result instanceof Event && $event instanceof WordPressEvent) {
            $event->setReturnValue($result);
        }

        return $event;
    }

    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        foreach ($subscriber->getSubscribedEvents() as $eventName => $listener) {
            $this->addListener($eventName, [$subscriber, $listener[0]], $listener[1]);
        }
    }

    public function addListener($eventName, $listener, $priority = 10)
    {
        add_action($eventName, $listener, $priority, PHP_INT_MAX);
    }

    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        foreach ($subscriber->getSubscribedEvents() as $eventName => $listener) {
            $this->removeListener($eventName, [$subscriber, $listener[0]]);
        }
    }

    public function removeListener($eventName, $listener)
    {
        if (!isset($GLOBALS['wp_filter']) || !isset($GLOBALS['wp_filter'][$eventName])) {
            return;
        }

        foreach ($GLOBALS['wp_filter'][$eventName] as $priority => $functions) {
            $function = _wp_filter_build_unique_id($eventName, $listener, $priority);

            if (isset($functions[$function])) {
                remove_action($eventName, $listener, $priority);
            }
        }
    }
}
