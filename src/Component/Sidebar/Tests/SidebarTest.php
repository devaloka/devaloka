<?php
namespace Tests\Devaloka\Component\Sidebar;

use Brain\Monkey;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class SidebarTest
 *
 * @package Tests\Devaloka\Component\Sidebar
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

    // Tests for SidebarInterface::render()

    public function testRenderShouldInvokeDynamicSidebar()
    {
        $sidebar = $this->createSidebar();

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(true)
            ->once();

        Monkey::functions()->expect('dynamic_sidebar')
            ->with('test-sidebar');

        $html = $sidebar->render();
    }

    public function testRenderShouldReturnEmptyStringWhenTheSidebarIsNotActive()
    {
        $sidebar = $this->createSidebar();

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
        $sidebar = $this->createSidebar();

        Monkey::functions()->expect('is_active_sidebar')
            ->with('test-sidebar')
            ->andReturn(true)
            ->once();

        Monkey::functions()->expect('dynamic_sidebar')
            ->with('test-sidebar');

        $sidebar->display();
    }

    public function testDisplayShouldReturnEmptyStringWhenTheSidebarIsNotActive()
    {
        $sidebar = $this->createSidebar();

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
        $sidebar = $this->createSidebar();

        $sidebar->shouldReceive('getOptions')
            ->andReturn(['name' => 'Sidebar']);

        Monkey::functions()->expect('register_sidebar')
            ->with(['name' => 'Sidebar', 'id' => 'test-sidebar'])
            ->once();

        $sidebar->register();
    }

    public function testRegisterShouldAlwaysOverrideId()
    {
        $sidebar = $this->createSidebar();

        $sidebar->shouldReceive('getOptions')
            ->andReturn(['id' => 'test-sidebar-2']);

        Monkey::functions()->expect('register_sidebar')
            ->with(['id' => 'test-sidebar'])
            ->once();

        $sidebar->register();
    }

    // Tests for SidebarInterface::unregister()

    public function testUnregisterShouldInvokeUnregisterSidebar()
    {
        $sidebar = $this->createSidebar();

        Monkey::functions()->expect('unregister_sidebar')
            ->with('test-sidebar')
            ->once();

        $sidebar->unregister();
    }

    // Methods for the tests.

    protected function createSidebar()
    {
        $sidebar = Mockery::mock('Devaloka\Component\Sidebar\AbstractSidebar')->makePartial();

        $sidebar->shouldReceive('getId')
            ->andReturn('test-sidebar');

        return $sidebar;
    }
}
