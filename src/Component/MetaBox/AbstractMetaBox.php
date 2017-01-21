<?php
/**
 * Abstract MetaBox
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2017 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\MetaBox;

/**
 * Class AbstractMetaBox
 *
 * @package Devaloka\Component\MetaBox
 */
abstract class AbstractMetaBox implements MetaBoxInterface
{
    use MetaBoxTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $title;

    /**
     * The constructor.
     *
     * @param string $name The Meta Box name.
     * @param string $title The Meta Box title.
     */
    public function __construct($name, $title)
    {
        $this->name  = $name;
        $this->title = $title;
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
    public function getTitle()
    {
        return $this->title;
    }
}
