=== Can I Use Cookies ? ===
Contributors: fcaylus
Tags: cookie, cookies, consent, popup, gdpr, ccpa
Requires at least: 5.4
Tested up to: 5.7
Stable tag: trunk
Requires PHP: 7.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Ask the user for his consent about cookies and tracking, and comply with the EU GDPR privacy law and CCPA regulations.

== Description ==

Does one thing but does it right:

**Ask the user for his consent about cookies and tracking.**

### Features

- Display a popup on every page and ask the user for his consent about tracking
- "Approve" and "Deny" button: compliant with GDPR and CCPA
- Customisable texts and image on the popup
- Customisable style of the popup using CSS
- Available in 2 languages: English and French
- No branding, no ad on the admin panel. Just a new menu in the settings.

### How it works ?

The plugin will add a new menu under your settings, where you can set up the various texts and images used by the popup.
Then, a popup will appear on every public pages, asking the user for his consent about cookies and tracking, presenting him with 2 choices:

- **Approve**: Set a cookie `cookie-consent=yes` valid for 6 months
- **Deny**: Set a cookie `cookie-consent=no` valid for 6 months

It's then up to you, and your analytics solution, to check for the `cookie-consent` value and handle it according to the user's wishes.

### How to customize the popup style ?

A default style is applied to the popup, with the strict minimum (the layout of the popup).
The popup will inherit the text style, button style and colors from your theme.

However, you can use CSS to customize the popup layout and style
(by enqueuing a stylesheet in your `functions.php` file, add additional CSS in your theme's options,
or whatever technique to add CSS to your page).

For reference, here is the popup HTML code. You can use the main container id (`#can-i-use-cookies`)
to scope your CSS rules.

`
<div id="can-i-use-cookies">
    <div class="container">
        <div class="subcontainer">
            <img class="image" src="...">
            <div class="text-container">
                <p class="title">...</p>
                <p class="description">...</p>
            </div>
        </div>
        <div class="button-bar">
            <button id="can-i-use-cookies-yes" class="button">...</button>
            <button id="can-i-use-cookies-no" class="button">...</button>
        </div>
    </div>
</div>
`

### Source code

The source code is available on GitHub at [github.com/doky-fr/can-i-use-cookies](https://github.com/doky-fr/can-i-use-cookies).

Feel free to contribute !

== Frequently Asked Questions ==

== Screenshots ==

1. Settings menu
2. Desktop popup with Twenty-Twenty theme
3. Mobile popup with Twenty-Twenty theme
4. Desktop popup with Twenty-Nineteen theme
5. Mobile popup with Twenty-Nineteen theme
6. Desktop popup with custom styling, text and logo
7. Mobile popup with custom styling, text and logo

== Changelog ==

= 1.0.1 =
* Reformat PHP code
* Tested up to WordPress 5.7

= 1.0.0 =
* First public release
