<?php

use OnlineMenukaart\Plugin;

/**
 * Plugin Name:     Onlinemenukaart
 * Plugin URI:      https://onlinemenukaart.nl
 * Description:     Integreer Onlinemenukaart met je Wordpress site.
 * Author:          Blue Indigo Solutions
 * Author URI:      https://blueindigo.nl
 * Text Domain:     onlinemenukaart
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Onlinemenukaart
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', function () {

    if (!defined('ONLINEMENUKAART_API')) {
        define('ONLINEMENUKAART_API', 'https://onlinemenukaart.nl');
    }

    require_once 'vendor/autoload.php';

    /*
    |--------------------------------------------------------------------------
    | Create The Plugin.
    |--------------------------------------------------------------------------
    |
    */

    $plugin = new Plugin(
        __DIR__
    );

    /*
    |--------------------------------------------------------------------------
    | Turn On The Lights.
    |--------------------------------------------------------------------------
    |
    */

    $plugin->start();
});
