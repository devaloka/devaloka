<?php
/**
 * PostType
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\PostType;

/**
 * Class PostType
 *
 * @package Devaloka\Component\PostType
 */
class PostType implements PostTypeInterface
{
    use PostTypeTrait;

    /**
     * @var string The Post Type name.
     */
    protected $name;

    /**
     * @var mixed[] The Post Type options.
     */
    protected $options = [];

    /**
     * The constructor.
     *
     * @param string $name The Post Type name.
     * @param mixed[] $options The Post Type options.
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
