<?php
/**
 * Devaloka Template API.
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 */

use Ecailles\NullObject\NullObject;

if (!function_exists('devaloka')) {
    /**
     * @return Devaloka\Devaloka|NullObject
     */
    function devaloka()
    {
        if (defined(WP_DEBUG) && WP_DEBUG && !isset($GLOBALS['devaloka'])) {
            return new NullObject();
        }

        return $GLOBALS['devaloka'];
    }
}

if (!function_exists('devaloka_container')) {
    /**
     * @return \Devaloka\Component\DependencyInjection\ContainerInterface|NullObject
     */
    function devaloka_container()
    {
        return devaloka()->getContainer();
    }
}

if (!function_exists('devaloka_get')) {
    /**
     * @param string $id
     *
     * @return mixed|NullObject
     */
    function devaloka_get($id)
    {
        $container = devaloka_container();

        if (defined(WP_DEBUG) && WP_DEBUG && !$container->has($id)) {
            return new NullObject();
        }

        return $container->get($id);
    }
}

if (!function_exists('deva')) {
    /**
     * @see devaloka() :alias:
     *
     * @return Devaloka\Devaloka|NullObject
     */
    function deva()
    {
        return devaloka();
    }
}

if (!function_exists('deva_container')) {
    /**
     * @see devaloka_container() :alias:
     *
     * @return \Devaloka\Component\DependencyInjection\ContainerInterface|NullObject
     */
    function deva_container()
    {
        return devaloka_container();
    }
}

if (!function_exists('deva_get')) {
    /**
     * @see devaloka_get() :alias:
     *
     * @param string $id
     *
     * @return mixed|NullObject
     */
    function deva_get($id)
    {
        return devaloka_get($id);
    }
}

if (!function_exists('dl')) {
    /**
     * @see devaloka() :alias:
     *
     * @return Devaloka\Devaloka|NullObject
     */
    function dl()
    {
        return devaloka();
    }
}

if (!function_exists('dl_container')) {
    /**
     * @see devaloka_container() :alias:
     *
     * @return \Devaloka\Component\DependencyInjection\ContainerInterface|NullObject
     */
    function dl_container()
    {
        return devaloka_container();
    }
}

if (!function_exists('dl_get')) {
    /**
     * @see devaloka_get() :alias:
     *
     * @param string $id
     *
     * @return mixed|NullObject
     */
    function dl_get($id)
    {
        return devaloka_get($id);
    }
}
