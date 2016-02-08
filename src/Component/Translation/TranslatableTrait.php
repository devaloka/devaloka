<?php
/**
 * Translatable Trait
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Translation;

/**
 * Class TranslatableTrait
 *
 * @package Devaloka\Component\Translation
 */
trait TranslatableTrait
{
    use TranslatorAwareTrait;

    /**
     * @since 0.2.0 Introduced.
     */
    protected $textDomain;

    /**
     * @since 0.2.0 Introduced.
     */
    protected $domainPath;

    /**
     * @since 0.2.0 Introduced.
     */
    protected $locale;

    /**
     * @since 0.2.0 Introduced.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @since 0.2.0 Introduced.
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @since 0.2.0 Introduced.
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }

    /**
     * @since 0.2.0 Introduced.
     */
    public function setTextDomain($domain)
    {
        $this->textDomain = $domain;
    }

    /**
     * @since 0.2.0 Introduced.
     */
    public function getDomainPath()
    {
        return $this->domainPath;
    }

    /**
     * @since 0.2.0 Introduced.
     */
    public function setDomainPath($path)
    {
        $this->domainPath = $path;
    }

    public function trans($text, $context = null, $domain = null)
    {
        $domain     = ($domain !== null) ? $domain : $this->getTextDomain();
        $parameters = [
            'context' => $context,
        ];

        return $this->translator->trans($text, $parameters, $domain, null);
    }

    public function transNumber($single, $plural, $number, $context = null, $domain = null)
    {
        $domain     = ($domain !== null) ? $domain : $this->getTextDomain();
        $parameters = [
            'single'  => $single,
            'plural'  => $plural,
            'context' => $context,
        ];

        return $this->translator->transChoice($single, $number, $parameters, $domain, null);
    }
}
