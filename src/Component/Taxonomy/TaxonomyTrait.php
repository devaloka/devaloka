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

use Devaloka\Component\PostType\PostTypeInterface;
use RuntimeException;

/**
 * Trait TaxonomyTrait
 *
 * @package Devaloka\Taxonomy
 */
trait TaxonomyTrait
{
    /**
     * @var PostTypeInterface|string[] The object types that have the relation with the Taxonomy.
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
     * Adds an object type to the Taxonomy.
     *
     * @param PostTypeInterface|string $objectType The object type.
     */
    public function addObjectType($objectType)
    {
        /** @var string $objectTypeName */
        $objectTypeName = ($objectType instanceof PostTypeInterface) ? $objectType->getName() : $objectType;

        $taxonomyName = $this->getName();

        if (taxonomy_exists($taxonomyName)) {
            register_taxonomy_for_object_type($taxonomyName, $objectTypeName);
        }

        $this->objectTypes[$objectTypeName] = $objectType;
    }

    /**
     * Removes an object type from the Taxonomy.
     *
     * @param PostTypeInterface|string $objectType The object type.
     */
    public function removeObjectType($objectType)
    {
        /** @var string $objectTypeName */
        $objectTypeName = ($objectType instanceof PostTypeInterface) ? $objectType->getName() : $objectType;

        $taxonomyName = $this->getName();

        if (taxonomy_exists($taxonomyName)) {
            unregister_taxonomy_for_object_type($taxonomyName, $objectTypeName);
        }

        unset($this->objectTypes[$objectTypeName]);
    }

    /**
     * Gets object types that have the relation with the Taxonomy.
     *
     * @return PostTypeInterface|string[] The object types.
     */
    public function getObjectTypes()
    {
        $taxonomy    = get_taxonomy($this->getName());
        $objectTypes = ($taxonomy !== false) ? $taxonomy->object_type : [];
        $objectTypes = array_combine($objectTypes, $objectTypes);
        $objectTypes = array_merge($objectTypes, $this->objectTypes);

        return $objectTypes;
    }

    /**
     * Registers the Taxonomy.
     *
     * @throws RuntimeException If the Taxonomy cannot be registered.
     */
    public function register()
    {
        $objectTypes = array_keys($this->objectTypes);

        if (is_wp_error(register_taxonomy($this->getName(), $objectTypes, $this->getOptions()))) {
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
            return;
        }

        foreach ($this->objectTypes as $objectTypeName => $value) {
            if (!unregister_taxonomy_for_object_type($this->getName(), $objectTypeName)) {
                throw new RuntimeException('Cannot unregister the Taxonomy.');
            }
        }
    }
}
