<?php
/**
 * PostType Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\PostType;

use Devaloka\Component\Taxonomy\TaxonomyInterface;

/**
 * Interface PostTypeInterface
 *
 * @package Devaloka\Component\PostType
 *
 * @codeCoverageIgnore
 */
interface PostTypeInterface
{
    /**
     * Gets the Post Type name.
     *
     * @return string The Post Type name.
     */
    public function getName();

    /**
     * Gets the Post Type options.
     *
     * @return mixed[] The options.
     */
    public function getOptions();

    /**
     * Adds a Taxonomy to the Post Type.
     *
     * @param TaxonomyInterface $taxonomy An instance of TaxonomyInterface.
     */
    public function addTaxonomy(TaxonomyInterface $taxonomy);

    /**
     * Gets the Taxonomies that will be registered for the Post Type.
     *
     * @return TaxonomyInterface[] An array of TaxonomyInterface.
     */
    public function getTaxonomies();

    /**
     * Registers the Post Type.
     *
     * @throws \RuntimeException If the Post Type cannot be registered.
     */
    public function register();

    /**
     * Unregisters the Post Type.
     *
     * @throws \LogicException Always throw a LogicException because there are no functions to unregister NavMenu.
     */
    public function unregister();
}
