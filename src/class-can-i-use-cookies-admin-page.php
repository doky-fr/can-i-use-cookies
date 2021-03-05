<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require_once plugin_dir_path(__FILE__) . '/class-can-i-use-cookies-defaults.php';

class Can_I_Use_Cookies_Admin_Page
{
    private static $page_name = 'can-i-use-cookies-settings';
    private $options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    public function add_page()
    {
        add_options_page(
            __('Cookies Consent', 'can-i-use-cookies'),
            __('Cookies Consent', 'can-i-use-cookies'),
            'manage_options',
            self::$page_name,
            array($this, 'create_admin_page')
        );
    }

    public function create_admin_page()
    {
        // Refresh options
        $this->options = get_option('can-i-use-cookies');
        ?>
        <div class="wrap">
            <h1><? esc_html_e('Setup the cookies consent popup', 'can-i-use-cookies') ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('can-i-use-cookies');
                do_settings_sections(self::$page_name);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'can-i-use-cookies',
            'can-i-use-cookies',
            array($this, 'sanitize')
        );

        /*
         * Section: Texts
         */

        add_settings_section(
            'can-i-use-cookies-texts-section',
            __('Various texts of the popup', 'can-i-use-cookies'),
            array($this, 'print_section_info_texts'),
            self::$page_name
        );

        add_settings_field(
            'title',
            __('Title', 'can-i-use-cookies'),
            array($this, 'title_callback'),
            self::$page_name,
            'can-i-use-cookies-texts-section'
        );

        add_settings_field(
            'content',
            __('Content', 'can-i-use-cookies'),
            array($this, 'content_callback'),
            self::$page_name,
            'can-i-use-cookies-texts-section'
        );

        add_settings_field(
            'yes_button',
            __('"Accept" button', 'can-i-use-cookies'),
            array($this, 'yes_button_callback'),
            self::$page_name,
            'can-i-use-cookies-texts-section'
        );

        add_settings_field(
            'no_button',
            __('"Deny" button', 'can-i-use-cookies'),
            array($this, 'no_button_callback'),
            self::$page_name,
            'can-i-use-cookies-texts-section'
        );

        /*
         * Section: Image URL
         */

        add_settings_section(
            'can-i-use-cookies-images-section',
            __('Popup image', 'can-i-use-cookies'),
            array($this, 'print_section_info_images'),
            self::$page_name
        );

        add_settings_field(
            'image',
            __('Image URL', 'can-i-use-cookies'),
            array($this, 'image_callback'),
            self::$page_name,
            'can-i-use-cookies-images-section'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     *
     * @return array
     */
    public function sanitize(array $input): array
    {
        $new_input = array();

        if (isset($input['title'])) {
            $new_input['title'] = esc_html($input['title']);
        }

        if (isset($input['content'])) {
            $new_input['content'] = esc_html($input['content']);
        }

        if (isset($input['yes_button'])) {
            $new_input['yes_button'] = esc_html($input['yes_button']);
        }

        if (isset($input['no_button'])) {
            $new_input['no_button'] = esc_html($input['no_button']);
        }

        if (isset($input['image'])) {
            $new_input['image'] = esc_url($input['image']);
        }

        return $new_input;
    }


    public function print_section_info_texts()
    {
        esc_attr_e('Please specify the various texts used by the consent popup.', 'can-i-use-cookies');
    }

    public function print_section_info_images()
    {
        esc_attr_e('Please specify the URL of the image displayed in the consent popup.', 'can-i-use-cookies');
        print '<br/>';
        esc_attr_e('If omitted, a default cookie image will be displayed.', 'can-i-use-cookies');
    }

    public function title_callback()
    {
        printf(
            '<input type="text" name="can-i-use-cookies[title]" value="%s" placeholder="%s" />',
            isset($this->options['title']) ? esc_attr($this->options['title']) : '',
            Can_I_Use_Cookies_Defaults::title()
        );
    }

    public function content_callback()
    {
        printf(
            '<textarea name="can-i-use-cookies[content]" rows="5" cols="50" placeholder="%s">%s</textarea>',
            Can_I_Use_Cookies_Defaults::content(),
            isset($this->options['content']) ? esc_html($this->options['content']) : ''
        );
    }

    public function yes_button_callback()
    {
        printf(
            '<input type="text" name="can-i-use-cookies[yes_button]" value="%s" placeholder="%s"/>',
            isset($this->options['yes_button']) ? esc_attr($this->options['yes_button']) : '',
            Can_I_Use_Cookies_Defaults::yes_button()
        );
    }

    public function no_button_callback()
    {
        printf(
            '<input type="text" name="can-i-use-cookies[no_button]" value="%s" placeholder="%s"/>',
            isset($this->options['no_button']) ? esc_attr($this->options['no_button']) : '',
            Can_I_Use_Cookies_Defaults::no_button()
        );
    }

    public function image_callback()
    {
        printf(
            '<input type="text" name="can-i-use-cookies[image]" value="%s"/>',
            isset($this->options['image']) ? esc_url($this->options['image']) : ''
        );
    }
}
