<?php
/**
 * PostType Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\PostType;

use Devaloka\Component\Taxonomy\TaxonomyInterface;
use LogicException;
use RuntimeException;

/**
 * Trait PostTypeTrait
 *
 * @package Devaloka\Component\PostType
 *
 * @codeCoverageIgnore
 */
trait PostTypeTrait
{
    /**
     * @var TaxonomyInterface[] The Taxonomies which the Post Type belongs to.
     */
    protected $taxonomies = [];

    /**
     * Gets the Post Type name.
     *
     * @return string The Post Type name.
     */
    abstract public function getName();

    /**
     * Gets the Post Type options.
     *
     * @return mixed[] The options.
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Adds a Taxonomy to the Post Type.
     *
     * @param TaxonomyInterface $taxonomy An instance of TaxonomyInterface.
     */
    public function addTaxonomy(TaxonomyInterface $taxonomy)
    {
        $this->taxonomies[$taxonomy->getName()] = $taxonomy;
    }

    /**
     * Gets the Taxonomies that will be registered for the Post Type.
     *
     * @return TaxonomyInterface[] An array of TaxonomyInterface.
     */
    public function getTaxonomies()
    {
        return $this->taxonomies;
    }

    /**
     * Registers the Post Type.
     *
     * @throws RuntimeException If the Post Type cannot be registered.
     */
    public function register()
    {
        /** @var PostTypeInterface $this */

        $options    = $this->getOptions();
        $taxonomies = [];

        foreach ($this->getTaxonomies() as $taxonomy) {
            $taxonomies[] = $taxonomy->getName();
        }

        $options['taxonomies'] = $taxonomies;

        if (is_wp_error(register_post_type($this->getName(), $options))) {
            throw new RuntimeException('Cannot register the Post Type.');
        }
    }

    /**
     * Unregisters the menu.
     *
     * @throws LogicException Always throw a LogicException because there are no functions to unregister NavMenu.
     *
     * @see https://core.trac.wordpress.org/ticket/14761 #14761 (unregister_post_type()) – WordPress Trac
     */
    public function unregister()
    {
        throw new LogicException('unregister() is not implemented yet.');
    }
}
