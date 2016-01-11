<?php
/**
 * Event Dispatcher Aware Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\EventDispatcher;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Trait EventDispatcherAwareTrait
 *
 * @package Devaloka\Component\EventDispatcher
 *
 * @codeCoverageIgnore
 */
trait EventDispatcherAwareTrait
{
    protected $dispatcher;

    public function setEventDispatcher(EventDispatcherInterface $dispatcher = null)
    {
        $this->dispatcher = $dispatcher;
    }
}
