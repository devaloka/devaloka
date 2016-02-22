<?php
/**
 * Filter Function
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\EventConverter;

use Ecailles\CallableObject\CallableObject;
use ReflectionFunction;
use ReflectionMethod;

/**
 * Class FilterFunction
 *
 * @package Devaloka\Component\EventConverter
 */
class FilterFunction
{
    private $callable;

    private $acceptedArgs;

    private $parameters;

    private $reflection;

    public function __construct(CallableObject $callable, $acceptedArgs = 1)
    {
        $this->callable     = $callable;
        $this->acceptedArgs = $acceptedArgs;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function getAcceptedArgs()
    {
        return $this->acceptedArgs;
    }

    public function __invoke()
    {
        $arguments = array_slice(func_get_args(), 0, $this->acceptedArgs);

        return $this->invokeArgs($arguments);
    }

    public function invoke()
    {
        $arguments = array_slice(func_get_args(), 0, $this->acceptedArgs);

        return $this->callable->invokeArgs($arguments);
    }

    public function invokeArgs(array $arguments)
    {
        $arguments = array_slice($arguments, 0, $this->acceptedArgs);

        return $this->callable->invokeArgs($this->normalizeArguments($arguments));
    }

    public function hasParameters()
    {
        return (bool) $this->getReflection()->getNumberOfParameters();
    }

    public function getParameters()
    {
        if ($this->parameters !== null) {
            return $this->parameters;
        }

        $reflection       = $this->getReflection();
        $this->parameters = [];

        for ($i = 0, $length = $reflection->getNumberOfParameters(); $i < $length; $i ++) {
            $this->parameters[$i] = new FilterFunctionParameter($this->callable, $i);
        }

        return $this->parameters;
    }

    private function normalizeArguments(array $arguments)
    {
        $parameters = $this->getParameters();

        for ($i = 0, $length = count($parameters); $i < $length; $i ++) {
            if ($parameters[$i]->isPassedByReference()) {
                $arguments[$i] = & $arguments[$i];
            }
        }

        return $arguments;
    }

    private function getReflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->callable->isFunction() || $this->callable->isClosure()) {
            $this->reflection = new ReflectionFunction($this->callable->get());
        }

        if ($this->callable->isInstanceMethod() || $this->callable->isClassMethod()) {
            $callable         = $this->callable->get();
            $object           = $callable[0];
            $method           = $callable[1];
            $this->reflection = new ReflectionMethod($object, $method);
        }

        return $this->reflection;
    }
}
