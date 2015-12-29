<?php
/*
Plugin Name: Devaloka
Description: A WordPress plugin brings DI Container, Event Dispatcher to WordPress
Version: 0.5.2
Author: Whizark
Author URI: http://whizark.com
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: devaloka
Domain Path: /languages
Network: true
*/

if (!defined('ABSPATH')) {
    exit;
}

use Pimple\Container;
use Devaloka\Devaloka;
use Devaloka\DependencyInjection\PimpleContainerAdapter;
use Devaloka\Provider\DevalokaProvider;
use Devaloka\EventDispatcher\Provider\EventDispatcherProvider;

call_user_func(
    function () {
        $loader = require ABSPATH . 'vendor/autoload.php';

        $loader->addPsr4('Devaloka\\', __DIR__ . '/src/', true);

        $container = new PimpleContainerAdapter(new Container());

        $container->add('loader', $loader);
        $container->add('container', $container);

        $devaloka = new Devaloka($container);

        $devaloka->register(new DevalokaProvider(__FILE__));
        $devaloka->register(new EventDispatcherProvider());

        add_action('after_setup_theme', [$devaloka, 'boot'], PHP_INT_MAX);
    }
);

require 'includes/api.php';
