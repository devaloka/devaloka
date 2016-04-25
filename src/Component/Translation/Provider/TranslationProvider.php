<?php
/**
 * Translation Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 */

namespace Devaloka\Component\Translation\Provider;

use Pimple\Container;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Provider\ServiceProviderInterface;

/**
 * Class TranslationProvider
 *
 * @package Devaloka\Component\Translation\Provider
 */
class TranslationProvider implements ServiceProviderInterface
{
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('translator.class', 'Devaloka\\Component\\Translation\\WordPressTranslator');
        $container->add(
            'translator',
            function (Container $container) {
                return new $container['translator.class']();
            }
        );
    }
}
