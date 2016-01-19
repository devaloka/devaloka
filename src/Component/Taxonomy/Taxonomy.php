<?php
/**
 * Taxonomy
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Taxonomy;

/**
 * Class Taxonomy
 *
 * @package Devaloka\Component\Taxonomy
 */
class Taxonomy implements TaxonomyInterface
{
    use TaxonomyTrait;

    /**
     * @var string The Taxonomy key.
     */
    protected $name;

    /**
     * @var mixed[] The Taxonomy options.
     */
    protected $options = [];

    /**
     * The constructor.
     *
     * @param string $name The Taxonomy key.
     * @param mixed[] $options The Taxonomy options.
     */
    public function __construct($name, array $options = [])
    {
        $this->name    = $name;
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }
}
