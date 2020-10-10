<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Can_I_Use_Cookies {
	private static $_instance;

	public static function instance() {
		if ( self::$_instance === null ) {
			self::$_instance = new self();

			add_action( 'plugins_loaded', array( self::$_instance, 'load_textdomain' ) );
		}

		return self::$_instance;
	}

	public function __construct() {
		if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			// Admin config page
			require_once plugin_dir_path( __FILE__ ) . '/class-can-i-use-cookies-admin-page.php';
			new Can_I_Use_Cookies_Admin_Pages();
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_footer', array( $this, 'add_cookie_notice' ), 1000 );
		}
	}

	/**
	 * Load text domain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'can-i-use-cookies', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Register the JavaScript file
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'can-i-use-cookies',
			plugin_dir_url( __FILE__ ) . 'js/public.js',
			array(),
			CAN_I_USE_COOKIES_PLUGIN_VERSION,
			true
		);
	}

	/**
	 * Add notice
	 */
	public function add_cookie_notice() {
		$option = get_option( 'can-i-use-cookies' );

		if ( $option === false || ! is_array( $option ) ) {
			return;
		}

		?>
        <div id="can-i-use-cookies" style="display: none;">
            <div class="container">
                <div class="subcontainer">
                    <img src="<? echo $option['image']; ?>" alt="Cookie">
                    <div class="text-container">
                        <p class="title"><? echo $option['title']; ?></p>
                        <p class="description"><? echo nl2br($option['content']); ?></p>
                    </div>
                </div>
                <div class="button-bar">
                    <button id="can-i-use-cookies-yes"><? echo $option['yes_button']; ?></button>
                    <button id="can-i-use-cookies-no"><? echo $option['no_button']; ?></button>
                </div>
            </div>
        </div>
		<?php
	}
}