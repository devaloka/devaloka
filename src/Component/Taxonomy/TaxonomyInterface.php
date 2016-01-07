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
     * @return string $taxonomy The taxonomy key (must not exceed 32 characters).
     */
    public function getName();

    /**
     * @return mixed[]
     */
    public function getOptions();

    /**
     * @return null|\WP_Error WP_Error if errors, otherwise null.
     */
    public function register();

    /**
     * @return bool
     */
    public function unregister();
}
