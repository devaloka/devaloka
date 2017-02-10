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
use WP_Hook;

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

            /** @var WP_Hook $hooks */
            $hook = $GLOBALS['wp_filter'][$eventName];

            foreach ($hook as $priority => $callbacks) {
                foreach ($callbacks as $index => $value) {
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

                    $callbacks[$priority][$index]['function'] = $this->converter->create(
                        current_filter(),
                        $filterFunction
                    );

                    $callbacks[$priority][$index]['_devaloka_event_converter'] = true;
                }
            }
        }
    }
}
