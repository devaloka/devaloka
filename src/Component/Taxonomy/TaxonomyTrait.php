<?php
/**
 * Taxonomy Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Taxonomy;

/**
 * Trait TaxonomyTrait
 *
 * @package Devaloka\Taxonomy
 *
 * @codeCoverageIgnore
 */
trait TaxonomyTrait
{
    /**
     * @var string[]
     */
    protected $objectTypes = [];

    public function getOptions()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        /** @var TaxonomyInterface $this */

        return register_taxonomy($this->getName(), $this->objectTypes, $this->getOptions());
    }

    public function unregister()
    {
        if (count($this->objectTypes) < 1) {
            return false;
        }

        foreach ($this->objectTypes as $objectType) {
            if (!unregister_taxonomy_for_object_type($this->getName(), $objectType)) {
                return false;
            }
        }

        return true;
    }
}