<?php
/**
 * Callback Generator
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Shortcode;

use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;
use Ecailles\CallableObject\CallableObject;

/**
 * Class CallbackGenerator
 *
 * @package Devaloka\Component\Shortcode
 */
class CallbackGenerator
{
    /**
     * Generates a callback function for a Shortcode from a CallableObject.
     *
     * @param callable $callable A callback for the Shortcode.
     *
     * @return \Closure The generated callback function for the Shortcode.
     */
    public function generate(callable $callable)
    {
        $callable = new CallableObject($callable);

        $wrapper = function ($attributes, $content, $tag) use ($callable) {
            $defaults     = $this->generateDefaultAttributes($callable);
            $attributes   = shortcode_atts($defaults, $attributes, $tag);
            $attributes[] = $content;
            $attributes[] = $tag;

            return $callable->invokeArgs($attributes);
        };

        return $wrapper;
    }

    /**
     * Generates the default attributes from a CallableObject.
     *
     * @param CallableObject $callable An instance of CallableObject.
     *
     * @return mixed[] The generated default attributes.
     */
    protected function generateDefaultAttributes(CallableObject $callable)
    {
        $attributes = [];
        $reflection = $this->createReflection($callable);

        for ($i = 0, $length = $reflection->getNumberOfParameters(); $i < $length; $i ++) {
            $parameter = new ReflectionParameter($callable->get(), $i);
            $name      = $parameter->getName();

            if ($parameter->isOptional()) {
                $attributes[$name] = $parameter->getDefaultValue();
            } else {
                $attributes[$name] = null;
            }
        }

        return $attributes;
    }

    /**
     * Creates an instance of the ReflectionFunctionAbstract from a CallableObject.
     *
     * @param CallableObject $callable An instance of CallableObject.
     *
     * @return \ReflectionFunctionAbstract|null The created instance of the ReflectionFunctionAbstract.
     */
    protected function createReflection(CallableObject $callable)
    {
        $reflection = null;

        if ($callable->isFunction() || $callable->isClosure()) {
            $reflection = new ReflectionFunction($callable->get());
        }

        if ($callable->isInstanceMethod() || $callable->isClassMethod()) {
            /** @var string|object[] $rawCallable */
            $rawCallable = $callable->get();
            $reflection  = new ReflectionMethod($rawCallable[0], $rawCallable[1]);
        }

        return $reflection;
    }
}
