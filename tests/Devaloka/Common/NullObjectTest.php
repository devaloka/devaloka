<?php
namespace Tests\Devaloka\Common;

use Devaloka\Common\NullObject;
use PHPUnit_Framework_TestCase;

/**
 * Class NullObjectTest
 *
 * @package Tests\Devaloka\Common
 * @author Whizark
 */
class NullObjectTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCallShouldReturnNullObject()
    {
        $this->assertInstanceOf('Devaloka\Common\NullObject', NullObject::staticMethod());
    }

    public function testFunctionCallShouldReturnNullOjbect()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', $null());
    }

    public function testPropertyAccessShouldReturnNullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', $null->property);
    }

    public function testNullObjectShouldBeCastedToNullString()
    {
        $null = new NullObject();

        $this->assertSame((string) null, (string) $null);
    }

    public function testCloneShouldReturnNullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', clone $null);
    }

    public function testNullObjectShouldBeSerializedAsAnEmptyObject()
    {
        $null = new NullObject();

        $this->assertEquals('O:26:"Devaloka\Common\NullObject":0:{}', serialize($null));
    }

    public function testSerializedNullObjectShouldBeUnserializedAsANullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', unserialize(serialize($null)));
    }

    public function testNullObjectShouldBeSerializedAsAnEmptyJsonObject()
    {
        $null = new NullObject();

        $this->assertSame('{}', json_encode($null));
    }

    public function testCurrentShouldReturnNullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', $null->current());
    }

    public function testKeyShouldReturnNullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', $null->key());
    }

    public function testValidShouldReturnFalse()
    {
        $null = new NullObject();

        $this->assertFalse($null->valid());
    }

    public function testNullObjectShouldNotBeIteratedOver()
    {
        $counter = 0;

        foreach (new NullObject() as $key => $value) {
            $counter ++;
        }

        $this->assertSame(0, $counter);
    }

    public function testAnyOffsetShouldNotExist()
    {
        $null = new NullObject();

        $this->assertFalse(isset($null['key']));
    }

    public function testArrayAccessShouldReturnNullObject()
    {
        $null = new NullObject();

        $this->assertInstanceOf('Devaloka\Common\NullObject', $null['key']);
    }

    public function testNullObjectCountShouldBeZero()
    {
        $null = new NullObject();

        $this->assertSame(0, count($null));
    }
}
