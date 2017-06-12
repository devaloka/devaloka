<?php
namespace Devaloka\Component\Taxonomy\Tests;

use Brain\Monkey;
use Devaloka\Component\Taxonomy\Taxonomy;
use Devaloka\Component\Taxonomy\TaxonomyInterface;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class TaxonomyTest
 *
 * @package Devaloka\Component\Taxonomy\Tests
 * @author Whizark <devaloka@whizark.com>
 */
class TaxonomyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sets up a test.
     */
    protected function setUp()
    {
        Monkey\setUp();
    }

    /**
     * Tears down a test.
     */
    protected function tearDown()
    {
        Monkey\tearDown();
    }

    // Tests for Taxonomy::getName()

    public function testGetNameShouldReturnTheName()
    {
        $taxonomy = new Taxonomy('test-taxonomy');

        $this->assertSame('test-taxonomy', $taxonomy->getName());
    }

    // Tests for Taxonomy::getOptions()

    public function testGetOptionsShouldReturnTheOptions()
    {
        $taxonomy = new Taxonomy('test-post-type', ['menu_name' => 'Taxonomy']);

        $this->assertSame(['menu_name' => 'Taxonomy'], $taxonomy->getOptions());
    }

    // Tests for Taxonomy::addObjectType(), getObjectTypes()

    public function testAddObjectTypeWithStringShouldAddTaxonomy()
    {
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('get_taxonomy')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->never();

        $taxonomy->addObjectType('test-string-object-type');

        $this->assertArraySubset(
            ['test-string-object-type' => 'test-string-object-type'],
            $taxonomy->getObjectTypes(),
            true
        );
    }

    public function testAddObjectTypeWithPostTypeInterfaceShouldAddTaxonomy()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('get_taxonomy')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->never();

        $taxonomy->addObjectType($postType);

        $this->assertArraySubset(['test-post-type' => $postType], $taxonomy->getObjectTypes(), true);
    }

    public function testAddObjectTypeShouldRegisterTaxonomyIfItAlreadyExists()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(true);

        // With string.
        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-object-type')
            ->once();

        $taxonomy->addObjectType('test-object-type');

        // With PostTypeInterface.
        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-post-type')
            ->once();

        $taxonomy->addObjectType($postType);
    }

    // Tests for Taxonomy::removeObjectType(), getObjectTypes()

    public function testRemoveObjectTypeShouldRemoveTaxonomyWhichIsAddedWithString()
    {
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('get_taxonomy')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->never();

        $taxonomy->addObjectType('test-string-object-type');

        $this->assertArrayHasKey('test-string-object-type', $taxonomy->getObjectTypes());

        $taxonomy->removeObjectType('test-string-object-type');

        $this->assertArrayNotHasKey('test-string-object-type', $taxonomy->getObjectTypes());
    }

    public function testRemoveObjectTypeShouldRemoveTaxonomyWhichIsAddedWithPostTypeInterface()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('get_taxonomy')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->never();

        $taxonomy->addObjectType($postType);

        $this->assertArrayHasKey('test-post-type', $taxonomy->getObjectTypes());

        $taxonomy->removeObjectType($postType);

        $this->assertArrayNotHasKey('test-post-type', $taxonomy->getObjectTypes());
    }

    public function testRemoveObjectTypeShouldUnregisterTaxonomyIfItAlreadyExists()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(true);

        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-string-object-type')
            ->once();

        Monkey\Functions\expect('register_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-post-type')
            ->once();

        $taxonomy->addObjectType('test-string-object-type');
        $taxonomy->addObjectType($postType);

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-string-object-type')
            ->once();

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-post-type')
            ->once();

        $taxonomy->removeObjectType('test-string-object-type');
        $taxonomy->removeObjectType($postType);
    }

    // Tests for Taxonomy::getObjectTypes()

    public function testGetObjectTypeShouldMergeObjectTypesIfItAlreadyExists()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        Monkey\Functions\expect('get_taxonomy')
            ->with('test-taxonomy')
            ->andReturn($this->getGlobalTaxonomy());

        $this->assertArraySubset(['test-post-type' => 'test-post-type'], $taxonomy->getObjectTypes(), true);

        $taxonomy->addObjectType($postType);

        $this->assertArraySubset(['test-post-type' => $postType], $taxonomy->getObjectTypes(), true);
    }

    // Tests for Taxonomy::register()

    public function testRegisterShouldRegisterTaxonomy()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy', ['menu_name' => 'Taxonomy']);

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        $taxonomy->addObjectType('test-string-object-type');
        $taxonomy->addObjectType($postType);

        Monkey\Functions\expect('register_taxonomy')
            ->with('test-taxonomy', ['test-string-object-type', 'test-post-type'], ['menu_name' => 'Taxonomy'])
            ->once();

        Monkey\Functions\expect('is_wp_error')
            ->andReturn(false);

        $taxonomy->register();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testRegisterShouldThrowRuntimeExceptionWhenItFailed()
    {
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('register_taxonomy');
        Monkey\Functions\expect('is_wp_error')
            ->andReturn(true);

        $taxonomy->register();
    }

    // Tests for Taxonomy::unregister()

    public function testUnregisterShouldUnregisterTaxonomy()
    {
        $postType = $this->createPostType();
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        $taxonomy->addObjectType('test-string-object-type');
        $taxonomy->addObjectType($postType);

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-string-object-type')
            ->andReturn(true)
            ->once();

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->with('test-taxonomy', 'test-post-type')
            ->andReturn(true)
            ->once();

        $taxonomy->unregister();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUnregisterShouldThrowRuntimeExceptionWhenItFailed()
    {
        $taxonomy = new Taxonomy('test-taxonomy');

        Monkey\Functions\expect('taxonomy_exists')
            ->with('test-taxonomy')
            ->andReturn(false);

        $taxonomy->addObjectType('test-string-object-type');

        Monkey\Functions\expect('unregister_taxonomy_for_object_type')
            ->andReturn(false);

        $taxonomy->unregister();
    }

    // Methods for the tests.

    protected function getGlobalTaxonomy()
    {
        $taxonomy              = new \StdClass();
        $taxonomy->object_type = ['test-post-type'];

        return $taxonomy;
    }

    protected function createPostType()
    {
        $postType = Mockery::mock('Devaloka\Component\PostType\PostTypeInterface');

        $postType->shouldReceive('getName')
            ->andReturn('test-post-type');

        return $postType;
    }

    protected function createTaxonomy()
    {
        $taxonomy = Mockery::mock('Devaloka\Component\Taxonomy\AbstractTaxonomy')->makePartial();

        $taxonomy->shouldReceive('getName')
            ->andReturn('test-taxonomy');

        return $taxonomy;
    }
}
