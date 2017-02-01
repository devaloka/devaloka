<?php
/**
 * WordPress Provider
 *
 * @author Whizark <devaloka@whizark.com>
 * @see http://whizark.com
 * @copyright Copyright (C) 2014 Whizark.
 * @license MIT
 * @license GPL-2.0
 * @license GPL-3.0
 */

namespace Devaloka\Component\Wp\Provider;

use Pimple\Container;
use WP_Rewrite;
use wpdb;
use WP_Embed;
use WP_Styles;
use WP_Scripts;
use Devaloka\Devaloka;
use Devaloka\Component\DependencyInjection\ContainerInterface;
use Devaloka\Component\DependencyInjection\ContainerAwareInterface;
use Devaloka\Provider\ServiceProviderInterface;
use Devaloka\Provider\BootableProviderInterface;

/**
 * Class WordPressProvider
 *
 * @package Devaloka\Component\Wp\Provider
 */
class WordPressProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Devaloka $devaloka, ContainerInterface $container)
    {
        // wpdb
        $container->add(
            'wpdb',
            function (Container $container) {
                if (isset($GLOBALS['wpdb'])) {
                    return $GLOBALS['wpdb'];
                }

                $wpdb            = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
                $GLOBALS['wpdb'] = $wpdb;

                return $wpdb;
            }
        );

        // WP_Embed
        $container->add(
            'wp_embed',
            function (Container $container) {
                if ($GLOBALS['wp_embed']) {
                    return $GLOBALS['wp_embed'];
                }

                $wpEmbed             = new WP_Embed();
                $GLOBALS['wp_embed'] = $wpEmbed;

                return $wpEmbed;
            }
        );

        // WP_Styles
        $container->add(
            'wp_styles',
            function (Container $container) {
                if ($GLOBALS['wp_styles']) {
                    return $GLOBALS['wp_styles'];
                }

                $wpStyles             = new WP_Styles();
                $GLOBALS['wp_styles'] = $wpStyles;

                return $wpStyles;
            }
        );

        // WP_Scripts
        $container->add(
            'wp_scripts',
            function (Container $container) {
                if ($GLOBALS['wp_scripts']) {
                    return $GLOBALS['wp_scripts'];
                }

                $wpScripts             = new WP_Scripts();
                $GLOBALS['wp_scripts'] = $wpScripts;

                return $wpScripts;
            }
        );

        // WP_Rewrite
        $container->add('wp_rewrite',
            function (Container $container) {
                if ($GLOBALS['wp_rewrite']) {
                    return $GLOBALS['wp_rewrite'];
                }

                $wpRewrite             = new WP_Rewrite();
                $GLOBALS['wp_rewrite'] = $wpRewrite;

                return $wpRewrite;
            }
        );

        // WP_Widget_Factory
        $container->add('wp_widget_factory.class', 'Devaloka\\Component\\Wp\\WpWidgetFactory');
        $container->add(
            'wp_widget_factory',
            function (Container $container) {
                if (isset($GLOBALS['wp_widget_factory']) &&
                    $GLOBALS['wp_widget_factory'] instanceof $container['wp_widget_factory.class']
                ) {
                    return $GLOBALS['wp_widget_factory'];
                }

                $wpWidgetFactory = new $container['wp_widget_factory.class']();

                if ($wpWidgetFactory instanceof ContainerAwareInterface) {
                    $wpWidgetFactory->setContainer($container['container']);
                }

                $GLOBALS['wp_widget_factory'] = $wpWidgetFactory;

                return $wpWidgetFactory;
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Devaloka $devaloka, ContainerInterface $container)
    {
        $GLOBALS['wp_widget_factory'] = $container->get('wp_widget_factory');
    }
}
