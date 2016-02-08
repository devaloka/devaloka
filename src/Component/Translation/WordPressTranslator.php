<?php
/**
 * WordPress Translator
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Translation;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class WordPressTranslator
 *
 * @package Devaloka\Component\Translation
 */
class WordPressTranslator implements TranslatorInterface
{
    protected $locale;

    public function __construct()
    {
        $this->locale = get_locale();
    }

    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        $domain     = ($domain !== null) ? $domain : 'default';
        $hasContext = (array_key_exists('context', $parameters) && $parameters['context'] !== null);
        $context    = $hasContext ? $parameters['context'] : null;

        if ($context !== null) {
            return _x($id, $context, $domain);
        }

        return __($id, $domain);
    }

    public function transChoice($id, $number, array $parameters = [], $domain = null, $locale = null)
    {
        $domain     = ($domain !== null) ? $domain : 'default';
        $hasSingle  = (array_key_exists('single', $parameters) && $parameters['single'] !== null);
        $hasPlural  = (array_key_exists('plural', $parameters) && $parameters['plural'] !== null);
        $hasContext = (array_key_exists('context', $parameters) && $parameters['context'] !== null);
        $single     = $hasSingle ? $parameters['single'] : $id;
        $plural     = $hasPlural ? $parameters['plural'] : $id;
        $context    = $hasContext ? $parameters['context'] : null;

        if ($context !== null) {
            return _nx($single, $plural, $number, $context, $domain);
        }

        return _n($single, $plural, $number, $domain);
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        throw new \InvalidArgumentException('Cannot change to the locale for the Translator.');
    }
}
