<?php
namespace Devaloka\Component\PostType\Tests;

use Brain\Monkey;
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

    // Tests for PostTypeInterface::register()

    public function testRegisterShouldInvokeRegisterPostTypeWithOptions()
    {
        $postType = $this->createPostType();

        $postType->shouldReceive('getOptions')
            ->andReturn(['menu_name' => 'Test Post Type']);

        Monkey::functions()->expect('register_post_type')
            ->with('test-post-type', ['menu_name' => 'Test Post Type'])
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
        $postType = $this->createPostType();

        $postType->shouldReceive('getOptions')
            ->andReturn(['menu_name' => 'Test Post Type']);

        Monkey::functions()->expect('register_post_type')
            ->with('test-post-type', ['menu_name' => 'Test Post Type'])
            ->once();

        Monkey::functions()->expect('is_wp_error')
            ->andReturn(true)
            ->once();

        $postType->register();
    }

    // Tests for PostTypeInterface::unregister()

    /**
     * @expectedException \LogicException
     */
    public function testUnregisterShouldAlwaysThrowLogicException()
    {
        $postType = $this->createPostType();

        $postType->unregister();
    }

    // Methods for the tests.

    protected function createPostType()
    {
        $postType = Mockery::mock('Devaloka\Component\PostType\AbstractPostType')->makePartial();

        $postType->shouldReceive('getName')
            ->andReturn('test-post-type');

        return $postType;
    }
}
