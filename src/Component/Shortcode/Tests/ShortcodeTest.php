<?php
namespace Devaloka\Component\Shortcode\Tests;

use Brain\Monkey;
use Devaloka\Component\Shortcode\Shortcode;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class ShortcodeTest
 *
 * @package Devaloka\Component\Shortcode\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class ShortcodeTest extends PHPUnit_Framework_TestCase
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

    // Tests for Shortcode::__toString()

    public function testShortcodeCanBeCastedToAShortcodeString()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn([]);

        $this->assertSame('[test-shortcode /]', (string) $shortcode);
    }

    public function testShortcodeCanBeCastedToAShortcodeStringWithAttributes()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value1', 'key2']);

        $this->assertSame('[test-shortcode key1="value1" key2 /]', (string) $shortcode);
    }

    // Tests for Shortcode::getName()

    public function testGetNameShouldReturnTheTagName()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        $this->assertSame('test-shortcode', $shortcode->getName());
    }

    // Tests for Shortcode::getCallable()

    public function testGetGetCallableShouldReturnTheCallable()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        $this->assertSame($function, $shortcode->getCallable());
    }

    // Tests for Shortcode::getDefaultAttributes()

    public function testGetGetDefaultAttributesShouldReturnTheDefaultAttributes()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        $this->assertSame(['key1' => 'value1', 'key2'], $shortcode->getDefaultAttributes());
    }

    // Tests for Shortcode::generate()

    public function testGenerateShouldReturnTheSelfClosingShortcodeString()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn([]);

        $this->assertSame('[test-shortcode /]', $shortcode->generate());
    }

    public function testGenerateShouldReturnTheShortcodeString()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value1', 'key2']);

        $this->assertSame('[test-shortcode key1="value1" key2 /]', $shortcode->generate());
    }

    public function testGenerateShouldReturnTheShortcodeStringWithAttributes()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value2', 'key2', 'key3']);

        $this->assertSame(
            '[test-shortcode key1="value2" key2 key3 /]',
            $shortcode->generate(['key1' => 'value2', 'key3'])
        );
    }

    public function testGenerateShouldReturnTheShortcodeStringWithAContent()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value1', 'key2']);

        $this->assertSame(
            '[test-shortcode key1="value1" key2]content[/test-shortcode]',
            $shortcode->generate([], 'content')
        );
    }

    // Tests for Shortcode::invoke()

    public function testInvokeShouldInvokeDoShortcode()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('do_shortcode')
            ->with('[test-shortcode key1="value1" key2 /]')
            ->andReturn('Test Shortcode')
            ->once();

        $this->assertSame('Test Shortcode', $shortcode->invoke());
    }

    public function testInvokeShouldInvokeDoShortcodeWithAttributes()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value2', 'key2', 'key3']);

        Monkey::functions()->expect('do_shortcode')
            ->with('[test-shortcode key1="value2" key2 key3 /]')
            ->andReturn('Test Shortcode')
            ->once();

        $this->assertSame('Test Shortcode', $shortcode->invoke(['key1' => 'value2', 'key3']));
    }

    public function testInvokeShouldInvokeDoShortcodeWithAContent()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function, ['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('shortcode_atts')
            ->andReturn(['key1' => 'value1', 'key2']);

        Monkey::functions()->expect('do_shortcode')
            ->with('[test-shortcode key1="value1" key2]content[/test-shortcode]')
            ->andReturn('Test Shortcode')
            ->once();

        $this->assertSame('Test Shortcode', $shortcode->invoke([], 'content'));
    }

    // Tests for Shortcode::register()

    public function testRegisterShouldInvokeAddShortcode()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function);

        Monkey::functions()->expect('add_shortcode')
            ->with('test-shortcode', $function)
            ->once();

        $shortcode->register();
    }

    // Tests for Shortcode::unregister()

    public function testUnregisterShouldInvokeRemoveShortcode()
    {
        $function  = function () {
        };
        $shortcode = new Shortcode('test-shortcode', $function);

        Monkey::functions()->expect('remove_shortcode')
            ->with('test-shortcode')
            ->once();

        $shortcode->unregister();
    }
}
