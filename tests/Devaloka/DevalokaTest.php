<?php
namespace Tests\Devaloka;

use Mockery;
use WP_UnitTestCase;

/**
 * Class DevalokaTest
 *
 * @package Tests\Devaloka
 * @author Whizark
 */
class DevalokaTest extends WP_UnitTestCase
{
    /**
     * Sets up the test case.
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function testTestClassShouldBeLoaded()
    {
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
