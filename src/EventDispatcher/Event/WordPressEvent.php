<?php
/**
 * WordPress Event
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\EventDispatcher\Event;

use OutOfRangeException;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class WordPressEvent
 *
 * @package Devaloka\EventDispatcher\Event
 */
class WordPressEvent extends Event
{
    protected $parameters = [];

    protected $returnValue;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function setParameter($index, $value)
    {
        $this->parameters[$index] = $value;
    }

    public function getParameter($index)
    {
        if (!$this->hasParameter($index)) {
            throw new OutOfRangeException(sprintf('Undefined index: %s.', $index));
        }

        return $this->parameters[$index];
    }

    public function hasParameter($index)
    {
        return isset($this->parameters[$index]);
    }

    public function addParameter($value)
    {
        $this->parameters[] = $value;
    }

    public function getReturnValue()
    {
        return $this->returnValue;
    }

    public function setReturnValue($value)
    {
        $this->returnValue = $value;
    }
}
