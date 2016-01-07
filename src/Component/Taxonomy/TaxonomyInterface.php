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
     * @return null|\WP_Error WP_Error if errors, otherwise null.
     */
    public function register();

    /**
     * Unregisters the Taxonomy.
     *
     * @return bool True on success, false on failure.
     */
    public function unregister();
}
