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
