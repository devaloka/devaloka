<?php
/**
 * Translator Aware Interface
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Translation;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * Interface TranslatorAwareInterface
 *
 * @package Devaloka\Translation
 *
 * @codeCoverageIgnore
 */
interface TranslatorAwareInterface
{
    public function setTranslator(TranslatorInterface $translator);
}
