<?php
namespace Tests\Devaloka;

use Brain\Monkey;
use PHPUnit_Framework_TestCase;

/**
 * Class DevalokaTest
 *
 * @package Tests\Devaloka
 * @author Whizark
 */
class DevalokaTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up a test.
     */
    protected function setUp()
    {
        Monkey::setUpWP();
    }

    public function testTestClassShouldBeLoaded()
    {
    }

    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Monkey::tearDownWP();
    }
}
