<?php
namespace Devaloka\Component\Sidebar\Tests;

use Brain\Monkey;
use Devaloka\Component\Sidebar\Sidebar;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class SidebarTest
 *
 * @package Devaloka\Component\Sidebar\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class SidebarTest extends PHPUnit_Framework_TestCase
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

    // Tests for SidebarInterface::getId()

    public function testGetIdShouldReturnTheId()
    {
        $sidebar = new Sidebar('test-sidebar');

        $this->assertSame('test-sidebar', $sidebar->getId());
    }

    // Tests for SidebarInterface::getOptions()

    public function testGetOptionsShouldReturnTheOptions()
    {
        $sidebar = new Sidebar('test-sidebar', ['name' => 'Sidebar']);

        $this->assertSame(['name' => 'Sidebar'], $sidebar->getOptions());
    }

    // Tests for SidebarInterface::render()

    public function testRenderShouldInvokeDynamicSidebar()
    {
        $sidebar = new Sidebar('test-sidebar');

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(true);

        Monkey::functions()->expect('dynamic_sidebar')
            ->with('test-sidebar')
            ->once();

        $html = $sidebar->render();
    }

    public function testRenderShouldReturnEmptyStringWhenTheSidebarIsNotActive()
    {
        $sidebar = new Sidebar('test-sidebar');

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(false);

        Monkey::functions()->expect('dynamic_sidebar')
            ->never();

        $html = $sidebar->render();

        $this->assertSame('', $html);
    }

    // Tests for SidebarInterface::display()

    public function testDisplayShouldInvokeDynamicSidebar()
    {
        $sidebar = new Sidebar('test-sidebar');

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(true);

        Monkey::functions()->expect('dynamic_sidebar')
            ->with('test-sidebar')
            ->once();

        $sidebar->display();
    }

    public function testDisplayShouldReturnEmptyStringWhenTheSidebarIsNotActive()
    {
        $sidebar = new Sidebar('test-sidebar');

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(false);

        Monkey::functions()->expect('dynamic_sidebar')
            ->never();

        $sidebar->display();
    }

    // Tests for SidebarInterface::register()

    public function testRegisterShouldInvokeRegisterSidebarWithOptions()
    {
        $options         = ['name' => 'Sidebar'];
        $expectedOptions = ['name' => 'Sidebar', 'id' => 'test-sidebar'];

        $sidebar = new Sidebar('test-sidebar', $options);

        Monkey::functions()->expect('register_sidebar')
            ->with($expectedOptions)
            ->once();

        $sidebar->register();
    }

    public function testRegisterShouldAlwaysOverrideId()
    {
        $options         = ['id' => 'test-sidebar-2'];
        $expectedOptions = ['id' => 'test-sidebar'];

        $sidebar = new Sidebar('test-sidebar', $options);

        Monkey::functions()->expect('register_sidebar')
            ->with($expectedOptions)
            ->once();

        $sidebar->register();
    }

    // Tests for SidebarInterface::unregister()

    public function testUnregisterShouldInvokeUnregisterSidebar()
    {
        $sidebar = new Sidebar('test-sidebar');

        Monkey::functions()->expect('unregister_sidebar')
            ->with('test-sidebar')
            ->once();

        $sidebar->unregister();
    }
}
