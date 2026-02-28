<?php
/**
 * Theme setup class.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\theme;

class Setup
{
    /**
     * Initializes theme setup
     *
     * Theme support features, textdomain loading,
     * navigation menus registration, session start and emoji disabling.
     */
    public function init(): void
    {
        add_action('after_setup_theme', [$this, 'themeSupport']);
        add_action('after_setup_theme', [$this, 'loadTextdomain']);
        add_action('after_setup_theme', [$this, 'registerNavMenus']);
        if ( ! apply_filters('bitski-wp-theme/option/load-emojis', null)) {
            add_action('after_setup_theme', [$this, 'disableEmojis']);
        }

        add_action('template_redirect', [$this, 'startSession']);
    }

    /**
     * Adds theme support features.
     */
    public function themeSupport(): void
    {
        // Core features
        add_theme_support('title-tag');

        // Content features
        add_theme_support('post-thumbnails');
        add_theme_support('menus');

        // Block editor features
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');

        // Frontend features
        add_theme_support(
            'html5',
            [
                'caption',
                'comment-form',
                'comment-list',
                'gallery',
                'search-form'
            ]
        );
    }

    /**
     * Loads theme textdomain for translations.
     */
    public function loadTextdomain(): void
    {
        load_theme_textdomain('bitski-wp-theme', get_template_directory().'/languages');
    }

    /**
     * Registers theme navigation menus.
     */
    public function registerNavMenus(): void
    {
        register_nav_menus([
            'main-menu'   => __('Main menu', 'bitski-wp-theme'),
            'footer-menu' => __('Footer menu', 'bitski-wp-theme'),
        ]);
    }

    /**
     * Disables WordPress emojis.
     * Removes emoji scripts from the frontend, backend, email + rss outputs, TinyMCE editor.
     *
     * @since 0.18.0
     */
    public function disableEmojis(): void
    {
        // Frontend: removes script.
        remove_action('wp_head', 'print_emoji_detection_script', 7);

        // Backend: removes script.
        remove_action('admin_print_scripts', 'print_emoji_detection_script');

        // Feeds + E-Mails: removes emojis from output.
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

        // TinyMCE-Editor: removes wpemoji plugin from TinyMCE.
        add_filter('tiny_mce_plugins', function ($plugins): array {
            if (is_array($plugins)) {
                return array_diff($plugins, ['wpemoji']);
            }

            return [];
        });
    }

    /**
     * Starts session if its not already started and
     * if current page is in the option array of pages using sessions.
     */
    public function startSession(): void
    {
        // Returns early if session is already started.
        if (session_id()) {
            return;
        }

        // Security check if headers are already sent.
        // Returns early if so, no session can be started.
        if (headers_sent($file, $line)) {
            error_log("Session could not be started. Headers already sent in $file on line $line.");

            return;
        }

        // Checks if current page is in the option array of pages using sessions.
        $pages_using_session_ids = apply_filters('bitski-wp-theme/option/pages/using-session/ids', []);
        foreach ($pages_using_session_ids as $id) {
            if (is_page($id)) {
                session_start();
                break;
            }
        }
    }
}
