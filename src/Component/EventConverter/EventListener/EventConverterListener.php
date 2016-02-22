<?php
/**
 * Event Converter Listener
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\EventConverter\EventListener;

use Ecailles\CallableObject\CallableObject;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Devaloka\Component\EventConverter\FilterFunction;
use Devaloka\Component\EventConverter\EventConverter;

/**
 * Class EventConverterListener
 *
 * @package Devaloka\Component\EventConverter\EventListener
 */
class EventConverterListener implements EventSubscriberInterface
{
    /**
     * @var EventConverter
     */
    private $converter;

    /**
     * @param EventConverter $converter
     */
    public function __construct(EventConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'all' => ['onAll', ~PHP_INT_MAX],
        ];
    }

    /**
     * @param string $tag
     */
    public function onAll($tag)
    {
        foreach (['all', $tag] as $eventName) {
            if (!isset($GLOBALS['wp_filter'][$eventName])) {
                continue;
            }

            foreach ($GLOBALS['wp_filter'][$eventName] as $priority => $indices) {
                foreach ($indices as $index => $value) {
                    if ($value['function'] === [$this, __FUNCTION__]) {
                        continue;
                    }

                    if (isset($value['_devaloka_event_converter']) && $value['_devaloka_event_converter']) {
                        continue;
                    }

                    $filterFunction = new FilterFunction(
                        new CallableObject($value['function']),
                        $value['accepted_args']
                    );

                    $GLOBALS['wp_filter'][$eventName][$priority][$index]['function'] = $this->converter->create(
                        current_filter(),
                        $filterFunction
                    );

                    $GLOBALS['wp_filter'][$eventName][$priority][$index]['_devaloka_event_converter'] = true;
                }
            }
        }
    }
}
