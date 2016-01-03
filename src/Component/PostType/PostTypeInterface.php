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
     * @return string
     */
    public function getName();

    /**
     * @return mixed[]
     */
    public function getOptions();

    /**
     * @param TaxonomyInterface $taxonomy
     */
    public function addTaxonomy(TaxonomyInterface $taxonomy);

    /**
     * @return \Devaloka\Component\Taxonomy\TaxonomyInterface[] An array of taxonomy ID(s) that will be registered for
     *                                                          the Post Type.
     */
    public function getTaxonomies();

    /**
     * @return object|\WP_Error The registered post type object, or an error object.
     */
    public function register();

    /**
     * @return bool|\WP_Error True on success, WP_Error on failure.
     */
    public function unregister();
}
