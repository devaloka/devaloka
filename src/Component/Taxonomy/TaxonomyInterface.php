<?php
/**
 * Taxonomy Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Taxonomy;

use Devaloka\Component\PostType\PostTypeInterface;

/**
 * Interface TaxonomyInterface
 *
 * @package Devaloka\Commponent\Taxonomy
 *
 * @codeCoverageIgnore
 */
interface TaxonomyInterface
{
    /**
     * Gets the Taxonomy key.
     *
     * @return string $taxonomy The Taxonomy key (must not exceed 32 characters).
     */
    public function getName();

    /**
     * Gets the Taxonomy options.
     *
     * @return mixed[] The options.
     */
    public function getOptions();

    /**
     * Adds an object type to the Taxonomy.
     *
     * @param PostTypeInterface|string $objectType The object type.
     */
    public function addObjectType($objectType);

    /**
     * Removes an object type from the Taxonomy.
     *
     * @param PostTypeInterface|string $objectType The object type.
     */
    public function removeObjectType($objectType);

    /**
     * Gets object types that have the relation with the Taxonomy.
     *
     * @return PostTypeInterface|string[] The object types.
     */
    public function getObjectTypes();

    /**
     * Registers the Taxonomy.
     *
     * @throws \RuntimeException If the Taxonomy cannot be registered.
     */
    public function register();

    /**
     * Unregisters the Taxonomy.
     *
     * @throws \RuntimeException If the Taxonomy cannot be unregistered.
     */
    public function unregister();
}
