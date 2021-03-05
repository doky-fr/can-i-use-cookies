<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require_once plugin_dir_path(__FILE__) . '/class-can-i-use-cookies-defaults.php';

class Can_I_Use_Cookies
{
    private static $_instance;

    public function __construct()
    {
        if (is_admin() && !(defined('DOING_AJAX') && DOING_AJAX)) {
            require_once plugin_dir_path(__FILE__) . '/class-can-i-use-cookies-admin-page.php';
            new Can_I_Use_Cookies_Admin_Page();
        } else {
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_action('wp_footer', array($this, 'add_cookie_notice'), 1000);
        }
    }

    public static function instance(): Can_I_Use_Cookies
    {
        if (self::$_instance === null) {
            self::$_instance = new self();

            add_action('plugins_loaded', array(self::$_instance, 'load_text_domain'));
        }

        return self::$_instance;
    }

    public function load_text_domain()
    {
        load_plugin_textdomain('can-i-use-cookies', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'can-i-use-cookies',
            plugin_dir_url(__FILE__) . 'can-i-use-cookies.js',
            array(),
            CAN_I_USE_COOKIES_PLUGIN_VERSION,
            true
        );
    }

    public function add_cookie_notice()
    {
        $option = get_option('can-i-use-cookies');
        ?>
        <div id="can-i-use-cookies" style="display: none;">
            <div class="container">
                <div class="subcontainer">
                    <img class="image"
                         src="<? echo $this->get_opt_val($option, 'image', Can_I_Use_Cookies_Defaults::image()); ?>"
                         alt="">
                    <div class="text-container">
                        <p class="title">
                            <? echo $this->get_opt_val($option, 'title', Can_I_Use_Cookies_Defaults::title()); ?>
                        </p>
                        <p class="description">
                            <? echo nl2br($this->get_opt_val($option, 'content', Can_I_Use_Cookies_Defaults::content())); ?>
                        </p>
                    </div>
                </div>
                <div class="button-bar">
                    <button id="can-i-use-cookies-yes">
                        <? echo $this->get_opt_val($option, 'yes_button', Can_I_Use_Cookies_Defaults::yes_button()); ?>
                    </button>
                    <button id="can-i-use-cookies-no">
                        <? echo $this->get_opt_val($option, 'no_button', Can_I_Use_Cookies_Defaults::no_button()); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_opt_val($option, $key, $default): string
    {
        if ($option === false || !array_key_exists($key, $option)) {
            return $default;
        }

        return $option[$key] ?: $default;
    }
}