<?php
/**
 * Plugin Name:       Can I Use Cookies ?
 * Plugin URI:        https://github.com/doky-fr/can-i-use-cookies
 * Description:       Ask the user for his consent about cookies and tracking, and comply with the EU GDPR privacy law and CCPA regulations.
 * Version:           {{plugin-version}}
 * Author:            Doky
 * Author URI:        https://doky.fr
 * Text Domain:       can-i-use-cookies
 * License:           GPLv3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Requires PHP:      7.0
 * Requires at least: 5.4
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('CAN_I_USE_COOKIES_PLUGIN_VERSION', '{{plugin-version}}');

require_once plugin_dir_path(__FILE__) . 'class-can-i-use-cookies.php';
Can_I_Use_Cookies::instance();