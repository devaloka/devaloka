<?php
namespace Devaloka\Component\DependencyInjection\Tests;

use Devaloka\Component\DependencyInjection\PimpleContainerAdapter;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class DependencyInjectionTest
 *
 * @package Devaloka\Component\DependencyInjection\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class DependencyInjectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSetShouldSetValueToPimple()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);

        $pimple->shouldReceive('offsetSet')
            ->with('id', 'value')
            ->once();

        $adapter->add('id', 'value');
    }

    public function testGetShouldReturnValueFromPimple()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);

        $pimple->shouldReceive('offsetGet')
            ->with('id')
            ->andReturn('value')
            ->once();

        $this->assertSame('value', $adapter->get('id'));
    }

    public function testHasShouldReturnTrueIfEntryExists()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);

        $pimple->shouldReceive('offsetExists')
            ->with('id')
            ->andReturn(true);

        $this->assertTrue($adapter->has('id'));
    }

    public function testHasShouldReturnFalseIfEntryDoesNotExist()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);

        $pimple->shouldReceive('offsetExists')
            ->with('id')
            ->andReturn(false);

        $this->assertFalse($adapter->has('id'));
    }

    public function testExtendShouldReturnValueFromPimpleExtend()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);
        $wrapper = function () {
        };

        $pimple->shouldReceive('extend')
            ->with('id', 'value')
            ->andReturn($wrapper)
            ->once();

        $this->assertSame($wrapper, $adapter->extend('id', 'value'));
    }

    public function testFactoryShouldReturnValueFromPimpleFactory()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);
        $factory = function () {
        };

        $pimple->shouldReceive('factory')
            ->with($factory)
            ->andReturn($factory)
            ->once();

        $this->assertSame($factory, $adapter->factory($factory));
    }

    public function testProtectShouldReturnValueFromPimpleProtect()
    {
        $pimple  = Mockery::mock('overload:Pimple\Container', 'ArrayAccess');
        $adapter = new PimpleContainerAdapter($pimple);
        $wrapper = function () {
        };

        $pimple->shouldReceive('protect')
            ->with('value')
            ->andReturn($wrapper)
            ->once();

        $this->assertSame($wrapper, $adapter->protect('value'));
    }
}
