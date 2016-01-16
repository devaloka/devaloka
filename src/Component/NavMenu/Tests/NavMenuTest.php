<?php
namespace Devaloka\Component\NavMenu\Tests;

use Brain\Monkey;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class NavMenuTest
 *
 * @package Devaloka\Component\NavMenu\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class NavMenuTest extends PHPUnit_Framework_TestCase
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

    // Tests for NavMenuInterface::render()

    public function testRenderShouldInvokeWpNavMenuWithDefaultOptions()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu', 'echo' => false];

        $navMenu = $this->createNavMenu($defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->andReturn('<nav></nav>')
            ->once();

        $html = $navMenu->render();

        $this->assertSame('<nav></nav>', $html);
    }

    public function testRenderShouldInvokeWpNavMenuWithOptios()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu-2', 'echo' => false];

        $navMenu = $this->createNavMenu($defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->andReturn('<nav></nav>')
            ->once();

        $html = $navMenu->render(['menu_id' => 'test-menu-2']);

        $this->assertSame('<nav></nav>', $html);
    }

    public function testRenderShouldAlwaysSetEchoToFalse()
    {
        $expectedOptions = ['echo' => false];

        $navMenu = $this->createNavMenu();

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->andReturn('<nav></nav>')
            ->once();

        $html = $navMenu->render(['echo' => true]);

        $this->assertSame('<nav></nav>', $html);
    }

    // Tests for NavMenuInterface::display()

    public function testDisplayShouldInvokeWpNavMenuWithDefaultOptions()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu', 'echo' => true];

        $navMenu = $this->createNavMenu($defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display();
    }

    public function testDisplayShouldInvokeWpNavMenuWithOptios()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu-2', 'echo' => true];

        $navMenu = $this->createNavMenu($defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display(['menu_id' => 'test-menu-2']);
    }

    public function testDisplayShouldAlwaysSetEchoToFalse()
    {
        $expectedOptions = ['echo' => true];

        $navMenu = $this->createNavMenu();

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display(['echo' => false]);
    }

    // Tests for NavMenuInterface::register()

    public function testRegisterShouldInvokeRegisterNavMenuWithLocationAndDescription()
    {
        $navMenu = $this->createNavMenu();

        Monkey::functions()->expect('register_nav_menu')
            ->with('location', 'Description.')
            ->once();

        $navMenu->register();
    }

    // Tests for NavMenuInterface::unregister()

    public function testUnregisterShouldInvokeUnregisterNavMenu()
    {
        $navMenu = $this->createNavMenu();

        Monkey::functions()->expect('unregister_nav_menu')
            ->with('location')
            ->andReturn(true)
            ->once();

        $navMenu->unregister();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUnregisterShouldThrowRuntimeExceptionIfItFailed()
    {
        $navMenu = $this->createNavMenu();

        Monkey::functions()->expect('unregister_nav_menu')
            ->with('location')
            ->andReturn(false)
            ->once();

        $navMenu->unregister();
    }

    // Methods for the tests.

    protected function createNavMenu(array $defaultOptions = [])
    {
        $navMenu = Mockery::mock('Devaloka\Component\NavMenu\AbstractNavMenu')->makePartial();

        $navMenu->shouldReceive('getLocation')
            ->andReturn('location');

        $navMenu->shouldReceive('getDescription')
            ->andReturn('Description.');

        $navMenu->shouldReceive('getDefaultOptions')
            ->andReturn($defaultOptions);

        return $navMenu;
    }
}
