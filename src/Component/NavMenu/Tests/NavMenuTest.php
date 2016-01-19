<?php
namespace Devaloka\Component\NavMenu\Tests;

use Brain\Monkey;
use Devaloka\Component\NavMenu\NavMenu;
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

    // Tests for NavMenuInterface::getLocation()

    public function testGetLocationShouldReturnTheLocation()
    {
        $navMenu = new NavMenu('location', 'Description.');

        $this->assertSame('location', $navMenu->getLocation());
    }

    // Tests for NavMenuInterface::getDescription()

    public function testGetDescriptionShouldReturnTheDescription()
    {
        $navMenu = new NavMenu('location', 'Description.');

        $this->assertSame('Description.', $navMenu->getDescription());
    }

    // Tests for NavMenuInterface::getDeffaultOptions()

    public function testGetDefaultOptionsShouldReturnTheDefaultOptions()
    {
        $navMenu = new NavMenu('location', 'Description.', ['menu_id' => 'test-menu']);

        $this->assertSame(['menu_id' => 'test-menu'], $navMenu->getDefaultOptions());
    }

    // Tests for NavMenuInterface::render()

    public function testRenderShouldInvokeWpNavMenuWithDefaultOptions()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu', 'echo' => false];

        $navMenu = new NavMenu('location', 'Description.', $defaultOptions);

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

        $navMenu = new NavMenu('location', 'Description.', $defaultOptions);

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

        $navMenu = new NavMenu('location', 'Description.');

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

        $navMenu = new NavMenu('location', 'Description.', $defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display();
    }

    public function testDisplayShouldInvokeWpNavMenuWithOptios()
    {
        $defaultOptions  = ['menu_id' => 'test-menu'];
        $expectedOptions = ['menu_id' => 'test-menu-2', 'echo' => true];

        $navMenu = new NavMenu('location', 'Description.', $defaultOptions);

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display(['menu_id' => 'test-menu-2']);
    }

    public function testDisplayShouldAlwaysSetEchoToFalse()
    {
        $expectedOptions = ['echo' => true];

        $navMenu = new NavMenu('location', 'Description.');

        Monkey::functions()->expect('wp_nav_menu')
            ->with($expectedOptions)
            ->once();

        $navMenu->display(['echo' => false]);
    }

    // Tests for NavMenuInterface::register()

    public function testRegisterShouldInvokeRegisterNavMenuWithLocationAndDescription()
    {
        $navMenu = new NavMenu('location', 'Description.');

        Monkey::functions()->expect('register_nav_menu')
            ->with('location', 'Description.')
            ->once();

        $navMenu->register();
    }

    // Tests for NavMenuInterface::unregister()

    public function testUnregisterShouldInvokeUnregisterNavMenu()
    {
        $navMenu = new NavMenu('location', 'Description.');

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
        $navMenu = new NavMenu('location', 'Description.');

        Monkey::functions()->expect('unregister_nav_menu')
            ->with('location')
            ->andReturn(false)
            ->once();

        $navMenu->unregister();
    }
}
