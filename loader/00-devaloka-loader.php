<?php
/*
Plugin Name: Devaloka
Description: A WordPress plugin brings DI Container, Event Dispatcher to WordPress
Version: 0.5.1
Author: Whizark
Author URI: http://whizark.com
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: devaloka
Domain Path: /devaloka/languages
Network: true
*/

if (!defined('ABSPATH')) {
    exit;
}

require WPMU_PLUGIN_DIR . '/devaloka/devaloka.php';
