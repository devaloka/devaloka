<?php
namespace Devaloka\Component\Widget\Tests;

use Brain\Monkey;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class ControlAwareWidgetTest
 *
 * @package Devaloka\Component\Widget\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class ControlAwareWidgetTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up a test.
     */
    protected function setUp()
    {
        Monkey\setUp();
    }

    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Monkey\tearDown();
    }

    public function testGetControlOptionsShouldReturnPropertyValue()
    {
        $wpWidget = $this->createWpWidget();
        $widget   = $this->createWidget();

        $widget->control_options = ['id_base' => 'test-id-base'];

        $this->assertSame(['id_base' => 'test-id-base'], $widget->getControlOptions());
    }

    public function testRenderFormShouldInvokeWpWidgetForm()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('form')
            ->with(['title' => 'Test'])
            ->once();

        $widget = $this->createWidget();

        $widget->renderForm(['title' => 'Test']);
    }

    public function testDisplayFormShouldInvokeWpWidgetForm()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('form')
            ->with(['title' => 'Test'])
            ->once();

        $widget = $this->createWidget();

        $widget->displayForm(['title' => 'Test']);
    }

    public function testFormShouldInvokeWpWidgetForm()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('form')
            ->with(['title' => 'Test'])
            ->once();

        $widget = $this->createWidget();

        $widget->form(['title' => 'Test']);
    }

    public function testUpdateShouldInvokeWpWidgetUpdate()
    {
        $wpWidget = $this->createWpWidget();

        $wpWidget->shouldReceive('update')
            ->with(['title' => 'Test 1'], ['title' => 'Test 2'])
            ->once();

        $widget = $this->createWidget();

        $widget->update(['title' => 'Test 1'], ['title' => 'Test 2']);
    }

    // Methods for the tests.

    protected function createWpWidget()
    {
        return Mockery::mock('overload:WP_Widget');
    }

    protected function createWidget()
    {
        return new TestControlAwareWidget();
    }
}
