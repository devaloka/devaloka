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

namespace Devaloka\Component\Taxonomy;

use RuntimeException;

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
     * @var string[] The object types that belongs to the Taxonomy.
     */
    protected $objectTypes = [];

    /**
     * Gets the Taxonomy key.
     *
     * @return string $taxonomy The Taxonomy key (must not exceed 32 characters).
     */
    abstract public function getName();

    /**
     * Gets the Taxonomy options.
     *
     * @return mixed[] The options.
     */
    public function getOptions()
    {
        return [];
    }

    /**
     * Registers the Taxonomy.
     *
     * @throws RuntimeException If the Taxonomy cannot be registered.
     */
    public function register()
    {
        /** @var TaxonomyInterface $this */

        if (is_wp_error(register_taxonomy($this->getName(), $this->objectTypes, $this->getOptions()))) {
            throw new RuntimeException('Cannot register the Taxonomy.');
        }
    }

    /**
     * Unregisters the Taxonomy.
     *
     * @throws \RuntimeException If the Taxonomy cannot be unregistered.
     */
    public function unregister()
    {
        if (count($this->objectTypes) < 1) {
            return false;
        }

        foreach ($this->objectTypes as $objectType) {
            if (!unregister_taxonomy_for_object_type($this->getName(), $objectType)) {
                throw new RuntimeException('Cannot unregister the Taxonomy.');
            }
        }
    }
}
