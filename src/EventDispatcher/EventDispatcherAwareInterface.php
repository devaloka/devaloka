<?php
/**
 * Event Dispatcher Aware Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface EventDispatcherAwareInterface
 *
 * @package Devaloka\EventDispatcher
 *
 * @codeCoverageIgnore
 */
interface EventDispatcherAwareInterface
{
    public function setEventDispatcher(EventDispatcherInterface $dispatcher = null);
}
