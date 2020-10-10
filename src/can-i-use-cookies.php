<?php
/**
 * Plugin Name:       Can I Use Cookies ?
 * Plugin URI:        https://doky.fr
 * Description:       Ask the user for his consent and comply with the EU GDPR privacy law and CCPA regulations.
 * Version:           {{plugin-version}}
 * Author:            Doky
 * Author URI:        https://doky.fr
 * Requires PHP:      7.0
 * Requires at least: 5.4
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'CAN_I_USE_COOKIES_PLUGIN_VERSION', '{{plugin-version}}' );

require_once plugin_dir_path( __FILE__ ) . 'class-can-i-use-cookies.php';

/**
 * Initialize Cookie Notice.
 */
function Can_I_Use_Cookies() {
	static $instance;

	// first call to instance() initializes the plugin
	if ( $instance === null || ! ( $instance instanceof Can_I_Use_Cookies ) )
		$instance = Can_I_Use_Cookies::instance();

	return $instance;
}

$can_i_use_cookies = Can_I_Use_Cookies();