<?php
namespace Devaloka\Component\Shortcode\Tests;

use Brain\Monkey;
use Devaloka\Component\Shortcode\CallbackGenerator;
use Ecailles\CallableObject\CallableObject;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class CallbackGeneratorTest
 *
 * @package Devaloka\Component\Shortcode\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class CallbackGeneratorTest extends PHPUnit_Framework_TestCase
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

    // Tests for CallbackGenerator::createReflection()

    public function testCreateReflectionShouldReturnReflectionFunctionForFunction()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $callable   = $this->createCallableObject('shortcodeCallback', true, false, false, false);
        $reflection = $generator->createReflection($callable);

        $this->assertInstanceOf('ReflectionFunction', $reflection);
    }

    public function testCreateReflectionShouldReturnReflectionFunctionForClosure()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $closure  = function () {
        };
        $callable = $this->createCallableObject($closure, false, true, false, false);

        $reflection = $generator->createReflection($callable);

        $this->assertInstanceOf('ReflectionFunction', $reflection);
    }

    public function testCreateReflectionShouldReturnReflectionMethodForInstanceMethod()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $callable   = $this->createCallableObject([$this, 'shortcodeCallback'], false, false, true, false);
        $reflection = $generator->createReflection($callable);

        $this->assertInstanceOf('ReflectionMethod', $reflection);
    }

    public function testCreateReflectionShouldReturnReflectionMethodForClassMethod()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $callable   = $this->createCallableObject([__CLASS__, 'staticShortcodeCallback'], false, false, false, true);
        $reflection = $generator->createReflection($callable);

        $this->assertInstanceOf('ReflectionMethod', $reflection);
    }

    // Tests for CallbackGenerator::generateDefaultAttributes()

    public function testDefaultAttributesShouldBeNothingIfCallableHasNoParameters()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $closure  = function () {
        };
        $callable = $this->createCallableObject($closure, false, true, false, false);

        $attributes = $generator->generateDefaultAttributes($callable);

        $this->assertSame([], $attributes);
    }

    public function testDefaultAttributeShouldBeNullIfTheParameterHasNoDefaultValue()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $closure  = function ($attr) {
        };
        $callable = $this->createCallableObject($closure, false, true, false, false);

        $attributes = $generator->generateDefaultAttributes($callable);

        $this->assertSame(['attr' => null], $attributes);
    }

    public function testDefaultAttributeShouldBeTheValueIfTheParameterHasDefaultValue()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $closure  = function ($attr = 'value') {
        };
        $callable = $this->createCallableObject($closure, false, true, false, false);

        $attributes = $generator->generateDefaultAttributes($callable);

        $this->assertSame(['attr' => 'value'], $attributes);
    }

    // Tests for CallbackGenerator::generate()

    public function testCallbackWrapperShouldPassAttributesToCallback()
    {
        $generator = Mockery::mock(new CallbackGenerator());

        $closure  = function ($atts1, $atts2 = 'value2') {
            return func_get_args();
        };
        $callable = $this->createCallableObject($closure, false, true, false, false);

        $attributes = ['atts1' => null, 'atts2' => 'value2'];

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn($attributes);

        $wrapper = $generator->generate($closure);

        $this->assertSame(
            [null, 'value2', 'content', 'test-shortcode'],
            $wrapper($attributes, 'content', 'test-shortcode')
        );
    }

    // Methods for tests

    public function createCallableObject(callable $callable, $isFunction, $isClosure, $isInstanceMethod, $isClassMethod)
    {
        $callbackObject = Mockery::mock('Ecailles\CallableObject\CallableObject');

        $callbackObject->shouldReceive('isFunction')
            ->andReturn($isFunction);

        $callbackObject->shouldReceive('isClosure')
            ->andReturn($isClosure);

        $callbackObject->shouldReceive('isInstanceMethod')
            ->andReturn($isInstanceMethod);

        $callbackObject->shouldReceive('isClassMethod')
            ->andReturn($isClassMethod);

        $callbackObject->shouldReceive('get')
            ->andReturn($callable);

        return $callbackObject;
    }

    public static function staticShortcodeCallback()
    {
    }

    public function shortcodeCallback()
    {
    }
}
