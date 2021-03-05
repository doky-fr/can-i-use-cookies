<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class Can_I_Use_Cookies_Defaults
{
    static public function title(): string
    {
        return __('This website uses cookies :)', 'can-i-use-cookies');
    }

    static public function content(): string
    {
        return __('We use cookies and other tracking technologies to improve your browsing experience on our website, to show you personalized content and targeted ads, to analyze our website traffic, and to understand where our visitors are coming from.', 'can-i-use-cookies');
    }

    static public function yes_button(): string
    {
        return __('Approve', 'can-i-use-cookies');
    }

    static public function no_button(): string
    {
        return __('Deny', 'can-i-use-cookies');
    }

    static public function image(): string
    {
        return plugin_dir_url(__FILE__) . 'cookie.png';
    }
}
