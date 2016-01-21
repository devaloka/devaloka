<?php
/**
 * Shortcode
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Shortcode;

use Ecailles\CallableObject\CallableObject;

/**
 * Class Shortcode
 *
 * @package Devaloka\Component\Shortcode
 */
class Shortcode implements ShortcodeInterface
{
    use ShortcodeTrait;

    /**
     * @var string The tag name.
     */
    protected $name;

    /**
     * @var callable The function.
     */
    protected $callable;

    /**
     * @var mixed[] The default attributes.
     */
    protected $defaultAttributes = [];

    /**
     * The constructor.
     *
     * @param string $name The tag name.
     * @param callable $callable The callable for the Shortcode processing.
     * @param mixed[] $defaultAttributes The default attributes.
     */
    public function __construct($name, callable $callable, array $defaultAttributes = [])
    {
        $this->name              = $name;
        $this->callable          = new CallableObject($callable);
        $this->defaultAttributes = $defaultAttributes;
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
    public function getCallable()
    {
        return $this->callable->get();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultAttributes()
    {
        return $this->defaultAttributes;
    }
}
