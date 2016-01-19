<?php
/**
 * Sidebar
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Sidebar;

/**
 * Class Sidebar
 *
 * @package Devaloka\Component\Sidebar
 */
class Sidebar implements SidebarInterface
{
    use SidebarTrait;

    /**
     * @var string The Sidebar ID.
     */
    protected $id;

    /**
     * @var mixed[] The Sidebar options.
     */
    protected $options = [];

    /**
     * The constructor.
     *
     * @param string $id The Sidebar ID.
     * @param mixed[] $options The Sidebar options.
     */
    public function __construct($id, array $options = [])
    {
        $this->id      = $id;
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getOptions()
    {
        return $this->options;
    }
}
