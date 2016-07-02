<?php
namespace Devaloka\Component\PostType\Tests;

use Brain\Monkey;
use Devaloka\Component\PostType\PostType;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class PostTypeTest
 *
 * @package Devaloka\Component\PostType\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class PostTypeTest extends PHPUnit_Framework_TestCase
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

    // Tests for PostType::getName()

    public function testGetNameShouldReturnTheName()
    {
        $postType = new PostType('test-post-type');

        $this->assertSame('test-post-type', $postType->getName());
    }

    // Tests for PostType::getOptions()

    public function testGetOptionsShouldReturnTheOptions()
    {
        $postType = new PostType('test-post-type', ['menu_name' => 'Test Post Type']);

        $this->assertSame(['menu_name' => 'Test Post Type'], $postType->getOptions());
    }

    // Tests for PostType::register()

    public function testRegisterShouldInvokeRegisterPostTypeWithOptions()
    {
        $options  = ['menu_name' => 'Test Post Type'];
        $postType = new PostType('test-post-type', $options);

        Monkey::functions()->expect('register_post_type')
            ->with('test-post-type', $options)
            ->once();

        Monkey::functions()->expect('is_wp_error')
            ->andReturn(false);

        $postType->register();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRegisterShouldThrowRuntimeExceptionWhenItFailed()
    {
        $options  = ['menu_name' => 'Test Post Type'];
        $postType = new PostType('test-post-type', $options);

        Monkey::functions()->expect('register_post_type')
            ->with('test-post-type', $options)
            ->once();

        Monkey::functions()->expect('is_wp_error')
            ->andReturn(true)
            ->once();

        $postType->register();
    }

    // Tests for PostType::unregister()

    public function testUnregisterShouldInvokeUnregisterPostType()
    {
        $postType = Mockery::mock('Devaloka\Component\PostType\PostType', ['test-post-type'])->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $postType->shouldReceive('supportsUnregistration')
            ->andReturn(true);

        Monkey::functions()->expect('unregister_post_type')
            ->with('test-post-type')
            ->once();

        Monkey::functions()->expect('is_wp_error')
            ->andReturn(false);

        $postType->unregister();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUnregisterShouldThrowRuntimeExceptionWhenItIsNotSupported()
    {
        $postType = Mockery::mock('Devaloka\Component\PostType\PostType', ['test-post-type'])->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $postType->shouldReceive('supportsUnregistration')
            ->andReturn(false);

        $postType->unregister();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUnregisterShouldThrowRuntimeExceptionWhenItFailed()
    {
        $postType = Mockery::mock('Devaloka\Component\PostType\PostType', ['test-post-type'])->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $postType->shouldReceive('supportsUnregistration')
            ->andReturn(true);

        Monkey::functions()->expect('unregister_post_type')
            ->with('test-post-type')
            ->once();

        Monkey::functions()->expect('is_wp_error')
            ->andReturn(true)
            ->once();

        $postType->unregister();
    }
}
