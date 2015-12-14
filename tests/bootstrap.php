<?php
if (getenv('WP_TESTS_LIB_PATH')) {
    require getenv('WP_TESTS_LIB_PATH') . '/includes/bootstrap.php';
} else {
    require '/tmp/wordpress-tests-lib/includes/bootstrap.php';
}

$loader = require ABSPATH . 'vendor/autoload.php';

$loader->add('Tests\\Devaloka\\', __DIR__ . '/Devaloka/');
