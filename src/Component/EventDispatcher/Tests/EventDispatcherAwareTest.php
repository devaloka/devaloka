<?php
namespace Devaloka\Component\EventDispatcher\Tests;

use Devaloka\Component\EventDispatcher\EventDispatcherAwareTrait;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class EventDispatcherAwareTest
 *
 * @package Devaloka\Component\EventDispatcher\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class EventDispatcherAwareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSetEventDispatcherCanSetEventDispatcherInterface()
    {
        $dispatcher      = Mockery::mock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $dispatcherAware = new TestEventDispatcherAware();

        $dispatcherAware->setEventDispatcher($dispatcher);
    }
}
