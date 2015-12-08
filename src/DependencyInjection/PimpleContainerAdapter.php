<?php
/**
 * Pimple Container Adapter
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\DependencyInjection;

use Pimple\Container;

/**
 * Class PimpleContainerAdapter
 *
 * @package Devaloka\DependencyInjection
 *
 * @codeCoverageIgnore
 */
class PimpleContainerAdapter implements ContainerInterface
{
    public function __construct(Container $pimple)
    {
        $this->pimple = $pimple;
    }

    public function get($id)
    {
        return $this->pimple[$id];
    }

    public function has($id)
    {
        return isset($this->pimple[$id]);
    }

    public function add($id, $value)
    {
        $this->pimple[$id] = $value;
    }

    public function extend($id, $value)
    {
        return $this->pimple->extend($id, $value);
    }

    public function factory($value)
    {
        return $this->pimple->factory($value);
    }

    public function protect($value)
    {
        return $this->pimple->protect($value);
    }
}
