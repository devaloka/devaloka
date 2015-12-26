<?php
namespace Tests\Devaloka\EventDispatcher;

use Brain\Monkey;
use Devaloka\EventDispatcher\EventDispatcher;
use Mockery;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up a test.
     */
    protected function setUp()
    {
        Monkey::setUpWP();
    }

    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Monkey::tearDownWP();
    }

    public function testDispatchShouldApplyFilters()
    {
        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    public function testDispatchActionEventShouldDoNothingIfListenerDoesNotExist()
    {
        $dispatcher = new EventDispatcher();
        $eventName  = 'action';

        Monkey::actions()->expectFired($eventName)->never();
        Monkey::filters()->expectApplied($eventName)->never();

        // Without Event object.
        $result = $dispatcher->dispatch($eventName);

        $this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $result);

        // With Event object.
        $actionEvent = Mockery::mock('Devaloka\EventDispatcher\Event\WordPressEvent');

        $actionEvent->shouldReceive('hasParameter')->with(0)->andReturn(false)->once();
        $actionEvent->shouldReceive('setReturnValue')->never();

        $result = $dispatcher->dispatch($eventName, $actionEvent);

        $this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $result);
    }

    public function testDispatchFilterEventShouldJustReturnEventItselfIfListenerDoesNotExist()
    {
        $dispatcher  = new EventDispatcher();
        $eventName   = 'filter';

        Monkey::actions()->expectFired($eventName)->never();
        Monkey::filters()->expectApplied($eventName)->never();

        // Withouth Event object.
        $result = $dispatcher->dispatch($eventName);

        $this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $result);

        // With Event object.
        $filterEvent = Mockery::mock('Devaloka\EventDispatcher\Event\WordPressEvent');

        $filterEvent->shouldReceive('hasParameter')->with(0)->andReturn(true)->once();
        $filterEvent->shouldReceive('getParameter')->with(0)->andReturn('filtered value')->once();
        $filterEvent->shouldReceive('setReturnValue')->with('filtered value')->once();

        $result = $dispatcher->dispatch($eventName, $filterEvent);

        $this->assertInstanceOf('Symfony\Component\EventDispatcher\Event', $result);
    }

    public function eventListenerProvider()
    {
        return [
            [
                'normal_event',
                function () {
                },
                10,
            ],
            [
                'high_priority_event',
                function () {
                },
                ~PHP_INT_MAX,
            ],
            [
                'low_priority_event',
                function () {
                },
                PHP_INT_MAX,
            ],
        ];
    }

    public function testHasListenerShouldReturnTrueWhenEventListenerExists()
    {
        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    public function testHasListenerShouldReturnFalseWhenEventListenerDoesNotExist()
    {
        $dispatcher = new EventDispatcher();

        $this->assertFalse($dispatcher->hasListeners());
        $this->assertFalse($dispatcher->hasListeners('unknown'));
    }

    public function testGetListenersShouldReturnEventListeners()
    {
        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    public function testGetListenersShouldReturnAnEmptyArrayWhenEventListenerDoesNotExist()
    {
        $dispatcher = new EventDispatcher();

        $this->assertSame([], $dispatcher->getListeners());
        $this->assertSame([], $dispatcher->getListeners('unknown'));
    }

    public function testAddSubscriberShouldAddActions()
    {
        $dispatcher = new EventDispatcher();

        /** @var EventSubscriberInterface|Mockery\MockInterface $subscriber */
        $subscriber = Mockery::mock('Symfony\Component\EventDispatcher\EventSubscriberInterface');

        $subscriber->shouldReceive('getSubscribedEvents')
            ->withNoArgs()
            ->andReturn(['event1' => ['onEvent1', 10], 'event2' => ['onEvent2', 11]])
            ->once()
            ->ordered();

        Monkey::actions()->expectAdded('event1')
            ->with([$subscriber, 'onEvent1'], 10, PHP_INT_MAX)
            ->once()
            ->ordered();

        Monkey::actions()->expectAdded('event2')
            ->with([$subscriber, 'onEvent2'], 11, PHP_INT_MAX)
            ->once()
            ->ordered();

        $dispatcher->addSubscriber($subscriber);
    }

    public function testAddSubscriberShouldDoNothingIfSubscriberHasNoEventsToSubscribe()
    {
        $dispatcher = new EventDispatcher();

        /** @var EventSubscriberInterface|Mockery\MockInterface $subscriber */
        $subscriber = Mockery::mock('Symfony\Component\EventDispatcher\EventSubscriberInterface');

        $subscriber->shouldReceive('getSubscribedEvents')
            ->withNoArgs()
            ->andReturn([])
            ->once()
            ->ordered();

        $dispatcher->addSubscriber($subscriber);
    }

    /**
     * @dataProvider eventListenerProvider
     *
     * @param string $eventName
     * @param callable $listener
     * @param int $priority
     */
    public function testAddListenerShouldAddAction($eventName, $listener, $priority)
    {
        $dispatcher = new EventDispatcher();

        Monkey::actions()->expectAdded($eventName)
            ->with($listener, $priority, PHP_INT_MAX)
            ->once();

        $dispatcher->addListener($eventName, $listener, $priority);
    }

    public function testRemoveSubscriberShouldRemoveActions()
    {
        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    public function testRemoveListenerShouldRemoveAction()
    {
        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    /**
     * @dataProvider eventListenerProvider
     *
     * @param string $eventName
     * @param callable $listener
     * @param int $priority
     */
    public function testGetListenerPriorityShouldReturnPriority($eventName, $listener, $priority)
    {
        // $dispatcher = new EventDispatcher();

        // Monkey::actions()->expectAdded($eventName)
        //     ->with($listener, $priority, PHP_INT_MAX)
        //     ->once();

        // $dispatcher->addListener($eventName, $listener, $priority);

        // $this->assertSame($priority, $dispatcher->getListenerPriority($eventName, $listener));

        $this->markTestIncomplete('Currently, marked as incomplete.');
    }

    public function testGetListenerPriorityShouldReturnNullIfListenerDoesNotExist()
    {
        $dispatcher = new EventDispatcher();

        $this->assertNull(
            $dispatcher->getListenerPriority(
                'unknown',
                function () {
                }
            )
        );
    }
}
