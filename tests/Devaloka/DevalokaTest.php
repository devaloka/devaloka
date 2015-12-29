<?php
namespace Tests\Devaloka;

use Devaloka\DependencyInjection\ContainerInterface;
use Devaloka\Devaloka;
use Devaloka\Provider\BootableProviderInterface;
use Devaloka\Provider\EventListenerProviderInterface;
use Devaloka\Provider\ServiceProviderInterface;
use Mockery;
use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DevalokaTest
 *
 * @package Tests\Devaloka
 * @author Whizark <devaloka@whizark.com>
 */
class DevalokaTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testRegisterShouldInvokeRegisterMethodOfServiceProvider()
    {
        $container = $this->createContainer();
        $devaloka  = new Devaloka($container);
        $provider  = $this->createServiceProvider();

        $provider->shouldReceive('register')
            ->with($devaloka, $container)
            ->once();

        $devaloka->register($provider);
    }

    public function testRegisterShouldAddOptionalValuesToContainer()
    {
        $container = $this->createContainer();
        $devaloka  = new Devaloka($container);
        $provider  = $this->createServiceProvider();

        $provider->shouldReceive('register')
            ->with($devaloka, $container)
            ->once()
            ->ordered();

        $container->shouldReceive('add')
            ->with('key1', 'value1')
            ->once()
            ->ordered();

        $container->shouldReceive('add')
            ->with('key2', 'value2')
            ->once()
            ->ordered();

        $devaloka->register($provider, ['key1' => 'value1', 'key2' => 'value2']);
    }

    public function testBootShouldInvokBootMethodOfBootableProviderOnlyOnce()
    {
        $container = $this->createContainer();
        $devaloka  = new Devaloka($container);
        $provider  = $this->createBootableProvider();

        $provider->shouldReceive('register')
            ->with($devaloka, $container)
            ->once()
            ->ordered();

        $provider->shouldReceive('boot')
            ->with($devaloka, $container)
            ->once()
            ->ordered();

        $devaloka->register($provider);

        $devaloka->boot();
        $devaloka->boot();
    }

    public function testBootShouldInvokSubscribeMethodOfEventListenerProviderOnlyOnce()
    {
        $container  = $this->createContainer();
        $devaloka   = new Devaloka($container);
        $dispatcher = $this->createEventDispatcher();
        $provider   = $this->createEventListenerProvider();

        $container->shouldReceive('get')
            ->with('event_dispatcher')
            ->andReturn($dispatcher);

        $provider->shouldReceive('register')
            ->with($devaloka, $container)
            ->once()
            ->ordered();

        $provider->shouldReceive('subscribe')
            ->with($devaloka, $container, $dispatcher)
            ->once()
            ->ordered();

        $devaloka->register($provider);

        $devaloka->boot();
        $devaloka->boot();
    }

    /**
     * @return ContainerInterface|Mockery\MockInterface
     */
    protected function createContainer()
    {
        return Mockery::mock('Devaloka\DependencyInjection\ContainerInterface');
    }

    /**
     * @return EventDispatcherInterface|Mockery\MockInterface
     */
    protected function createEventDispatcher()
    {
        return Mockery::mock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }

    /**
     * @return ServiceProviderInterface|Mockery\MockInterface
     */
    protected function createServiceProvider()
    {
        return Mockery::mock('Devaloka\Provider\ServiceProviderInterface');
    }

    /**
     * @return ServiceProviderInterface|EventListenerProviderInterface|Mockery\MockInterface
     */
    protected function createEventListenerProvider()
    {
        return Mockery::mock(
            'Devaloka\Provider\ServiceProviderInterface, Devaloka\Provider\EventListenerProviderInterface'
        );
    }

    /**
     * @return ServiceProviderInterface|BootableProviderInterface|Mockery\MockInterface
     */
    protected function createBootableProvider()
    {
        return Mockery::mock(
            'Devaloka\Provider\ServiceProviderInterface, Devaloka\Provider\BootableProviderInterface'
        );
    }
}
