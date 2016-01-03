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

/**
 * Trait PostTypeTrait
 *
 * @package Devaloka\Component\PostType
 *
 * @codeCoverageIgnore
 */
trait PostTypeTrait
{
    protected $taxonomies = [];

    public function addTaxonomy(TaxonomyInterface $taxonomy)
    {
        $this->taxonomies[$taxonomy->getName()] = $taxonomy;
    }

    public function register()
    {
        /** @var PostTypeInterface $this */

        $options    = $this->getOptions();
        $taxonomies = [];

        foreach ($this->getTaxonomies() as $taxonomy) {
            $taxonomies[] = $taxonomy->getName();
        }

        $options['taxonomies'] = $taxonomies;

        return register_post_type($this->getName(), $options);
    }

    /**
     * @throws LogicException
     *
     * @see https://core.trac.wordpress.org/ticket/14761 #14761 (unregister_post_type()) – WordPress Trac
     */
    public function unregister()
    {
        throw new LogicException('unregister() is not implemented yet.');
    }
}
