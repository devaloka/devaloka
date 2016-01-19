<?php
/**
 * NavMenu
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\NavMenu;

/**
 * Class NavMenu
 *
 * @package Devaloka\Component\NavMenu
 */
class NavMenu implements NavMenuInterface
{
    use NavMenuTrait;

    /**
     * @var string The menu location identifier.
     */
    protected $location;

    /**
     * @var string The menu location descriptive text.
     */
    protected $description;

    /**
     * @var mixed[] The default options for the menu.
     */
    protected $defaultOptions = [];

    /**
     * The constructor.
     *
     * @param string $location The menu location identifier.
     * @param string $description The menu location descriptive text.
     * @param mixed[] $defaultOptions The default options for the menu.
     */
    public function __construct($location, $description, array $defaultOptions = [])
    {
        $this->location       = $location;
        $this->description    = $description;
        $this->defaultOptions = $defaultOptions;
    }

    /**
     * {@inheritDoc}
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }
}
