<?php
/**
 * Event Converter
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\EventConverter;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Devaloka\Component\EventDispatcher\Event\WordPressEvent;

/**
 * Class EventConverter
 *
 * @package Devaloka\Component\EventConverter
 */
class EventConverter
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $eventName
     * @param FilterFunction $function
     *
     * @return callable
     */
    public function create($eventName, FilterFunction $function)
    {
        $converter = function ($event = null) use ($eventName, $function) {
            $arguments = func_get_args();

            return $this->invoke($eventName, $function, $arguments);
        };

        return $converter;
    }

    /**
     * @param string $eventName
     * @param FilterFunction $function
     * @param array $arguments
     *
     * @return WordPressEvent|mixed
     */
    public function invoke($eventName, FilterFunction $function, array $arguments)
    {
        $arguments    = !empty($arguments) ? $arguments : [null];
        $acceptsEvent = $function->hasParameters() &&
            $function->getParameters()[0]->allowsOnlyClass('Symfony\\Component\\EventDispatcher\\Event');

        // WordPressEvent to WordPressEvent.
        if ($acceptsEvent && $arguments[0] instanceof WordPressEvent) {
            $event = $this->convert($eventName, $arguments[0]);
            $event = $function->invokeArgs([$event, $eventName, $this->dispatcher]);

            return $event;
        }

        // WordPressEvent to arguments.
        if (!$acceptsEvent && $arguments[0] instanceof WordPressEvent) {
            $event  = $this->convert($eventName, $arguments[0]);
            $result = $function->invokeArgs($event->getParameters());

            $event->setReturnValue($result);

            return $event;
        }

        // Arguments to WordPressEvent.
        if ($acceptsEvent && !$arguments[0] instanceof WordPressEvent) {
            $event = $this->convert($eventName, $arguments);
            $event = $function->invokeArgs([$event, $eventName, $this->dispatcher]);

            return $event->getReturnValue();
        }

        // Arguments to arguments.
        return $function->invokeArgs($arguments);
    }

    /**
     * @param string $eventName
     * @param WordPressEvent|array $arguments
     *
     * @return WordPressEvent
     */
    public function convert($eventName, $arguments)
    {
        $event = ($arguments instanceof WordPressEvent) ? $arguments : new WordPressEvent($arguments);

        return $event;
    }
}
