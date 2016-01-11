<?php
/**
 * Devaloka Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2015 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Provider;

use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;

/**
 * Class DevalokaProvider
 *
 * @package Devaloka\Provider
 */
class DevalokaProvider implements ServiceProviderInterface, BootableProviderInterface
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        $container->add('devaloka.file', $this->file);
        $container->add('devaloka', $devaloka);

        $GLOBALS['devaloka'] = isset($GLOBALS['devaloka']) ? $GLOBALS['devaloka'] : $devaloka;
    }

    public function boot(Devaloka $devaloka, ContainerInterface $container)
    {
        require_once ABSPATH . '/wp-admin/includes/plugin.php';

        $file       = $container->get('devaloka.file');
        $pluginData = get_plugin_data($file, false, false);
        $directory  = dirname($file);

        if ($pluginData['TextDomain'] !== '') {
            $textDomain = $pluginData['TextDomain'];
        } else {
            $textDomain = basename($directory);
        }

        if ($pluginData['DomainPath'] !== '') {
            $domainPath = $pluginData['DomainPath'];
        } else {
            $domainPath = '/languages';
        }

        load_muplugin_textdomain($textDomain, dirname(plugin_basename($file)) . $domainPath);

        $locale     = get_locale();
        $localeFile = $directory . $domainPath . '/' . $locale . '.php';

        if (is_readable($localeFile)) {
            require_once $localeFile;
        }
    }
}
