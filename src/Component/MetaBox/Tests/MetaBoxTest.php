<?php
namespace Devaloka\Component\MetaBox\Tests;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class MetaBoxTest
 *
 * @package Tests\Devaloka\Component\MetaBox
 * @author Whizark <devaloka@whizark.com>
 */
class MetaBoxTest extends PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnTheName()
    {
        $metaBox = new TestMetaBox('test-meta-box', 'Test Meta Box');

        $this->assertSame('test-meta-box', $metaBox->getName());
    }

    public function testGetTitleShouldReturnTheTitle()
    {
        $metaBox = new TestMetaBox('test-meta-box', 'Test Meta Box');

        $this->assertSame('Test Meta Box', $metaBox->getTitle());
    }

    public function testRenderShouldReturnTheContent()
    {
        $post    = $this->createWpPost();
        $metaBox = new TestMetaBox('test-meta-box', 'Test Meta Box');

        $this->assertSame('Test Meta Box Content', $metaBox->render($post));
    }

    public function testDisplayshouldDisplayTheContent()
    {
        $post    = $this->createWpPost();
        $metaBox = new TestMetaBox('test-meta-box', 'Test Meta Box');

        ob_start();

        $metaBox->display($post);

        $actual = ob_get_clean();

        $this->assertSame('Test Meta Box Content', $actual);
    }

    // Methods for the tests.

    protected function createWpPost()
    {
        return Mockery::mock('overload:WP_Post');
    }
}
