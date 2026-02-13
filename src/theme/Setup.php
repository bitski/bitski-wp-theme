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
     * navigation menus registration, session start.
     */
    public function init(): void
    {
        add_action('after_setup_theme', [$this, 'themeSupport']);
        add_action('after_setup_theme', [$this, 'loadTextdomain']);
        add_action('after_setup_theme', [$this, 'registerNavMenus']);

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
