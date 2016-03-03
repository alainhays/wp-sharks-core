<?php
declare (strict_types = 1);
namespace WebSharks\WpSharks\Core;

use WebSharks\WpSharks\Core\Classes\App;

if (!defined('WPINC')) {
    exit('Do NOT access this file directly: '.basename(__FILE__));
}
require __DIR__.'/rv.php'; // Getup `wp_php_rv` config.

if (require(dirname(__DIR__).'/vendor/websharks/wp-php-rv/src/includes/check.php')) {
    add_action('plugins_loaded', function () {
        require_once __DIR__.'/stub.php';
        new App();
    }, -10000);
}
