<?php
namespace Tests\Devaloka\Common;

use Devaloka\EventDispatcher\Event\WordPressEvent;
use PHPUnit_Framework_TestCase;

/**
 * Class WordPressEventTest
 *
 * @package Tests\Devaloka\Common
 * @author Whizark <devaloka@whizark.com>
 */
class WordPressEventTest extends PHPUnit_Framework_TestCase
{
    public function testGetParameterShouldReturnTheSetValue()
    {
        $event = new WordPressEvent();

        $event->setParameter(0, 'parameter 0');

        $this->assertSame('parameter 0', $event->getParameter(0));
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testGetParameterShouldThrowOutOfRangeExceptionIfTheIndexDoesNotExist()
    {
        $event = new WordPressEvent();

        $event->getParameter(1);
    }

    public function testHasParameterShouldReturnTheValueIfTheIndexExists()
    {
        $event = new WordPressEvent();

        $event->setParameter(0, 'parameter 0');

        $this->assertTrue($event->hasParameter(0));
    }

    public function testHasParameterShouldReturnFalseIfTheIndexDoesNotExist()
    {
        $event = new WordPressEvent();

        $this->assertFalse($event->hasParameter(0));
    }

    public function testAddParameterShouldAppendAParameter()
    {
        $event = new WordPressEvent();

        $event->setParameter(0, 'parameter 0');
        $event->addParameter('parameter 1');

        $this->assertSame('parameter 0', $event->getParameter(0));
        $this->assertSame('parameter 1', $event->getParameter(1));

        $event->setParameter(3, 'parameter 3');
        $event->addParameter('parameter 4');

        $this->assertFalse($event->hasParameter(2));

        $this->assertSame('parameter 3', $event->getParameter(3));
        $this->assertSame('parameter 4', $event->getParameter(4));
    }
}
