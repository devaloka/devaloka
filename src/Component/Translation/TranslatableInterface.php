<?php
/**
 * Translatable Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Translation;

/**
 * Interface TranslatableInterface
 *
 * @package Devaloka\Component\Translation
 *
 * @codeCoverageIgnore
 */
interface TranslatableInterface extends TranslatorAwareInterface
{
    public function getLocale();

    /**
     * @since 0.2.0 Introduced.
     */
    public function setLocale($locale);

    public function getTextDomain();

    /**
     * @since 0.2.0 Introduced.
     */
    public function setTextDomain($domain);

    /**
     * @since 0.2.0 Introduced.
     */
    public function getDomainPath();

    /**
     * @since 0.2.0 Introduced.
     */
    public function setDomainPath($path);

    public function loadTextDomain($domain = null, $path = null);

    public function loadLocaleFile($locale = null, $path = null);

    public function trans($text, $domain = null, $context = null);

    public function transNumber($single, $plural, $number, $domain = null, $context = null);
}
