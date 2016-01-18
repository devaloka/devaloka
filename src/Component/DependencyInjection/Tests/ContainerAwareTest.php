<?php
namespace Devaloka\Component\DependencyInjection\Tests;

use Devaloka\Component\DependencyInjection\ContainerAwareTrait;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class ContainerAwareTest
 *
 * @package Devaloka\Component\DependencyInjection\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class ContainerAwareTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSetContainerCanSetContainerInterface()
    {
        $container      = Mockery::mock('Devaloka\Component\DependencyInjection\ContainerInterface');
        $containerAware = new TestContainerAware();

        $containerAware->setContainer($container);
    }
}
