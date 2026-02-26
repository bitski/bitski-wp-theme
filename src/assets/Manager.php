<?php
/**
 * Manages theme assets.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\assets;

/**
 * Manages theme assets.
 *
 * @since 0.1.0
 */
class Manager
{
    /**
     * Initializes the theme assets manager.
     */
    public function init(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets'], 0);
        add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets'], 0);
    }

    /**
     * Enqueues theme assets.
     *
     * @since 0.1.0
     */
    public function enqueueAssets(): void
    {
        $theme_version = wp_get_theme()->get('Version');
        $theme_uri     = get_template_directory_uri();
        $theme_dir     = get_template_directory();

        // Uses minified main.js if it exists, otherwise main.js.
        $theme_main_script = file_exists($theme_dir.'/assets/js/main.min.js') ? 'main.min.js' : 'main.js';

        // CSS
        //
        // Theme main style
        wp_enqueue_style(
            'bitski-wp-theme-style',
            $theme_uri.'/assets/css/main.css',
            [],
            $theme_version
        );

        // Fontawesome
        if (apply_filters('bitski-wp-theme/option/load-fontawesome', true)) {
            wp_enqueue_style(
                'fontawesome',
                $theme_uri.'/assets/fonts/fontawesome/css/all.min.css',
                [],
                '7.0.1'
            );
        }

        // Scripts
        //
        // Enqueues the main theme script as an ES6 JavaScript module.
        // This will load main.js with the correct type="module" attribute,
        // enabling native module imports within main.js (e.g., importing theme.js, bootstrap.bundle.min.js).
        // Requires WordPress 6.5 or higher for native wp_enqueue_script_module() support.
        wp_enqueue_script_module(
            'bitski-wp-theme-main-script',
            $theme_uri.'/assets/js/'.$theme_main_script,
            [],
            $theme_version
        );
    }

    /**
     * Enqueues block editor assets.
     *
     * @since 0.10.1
     */
    public function enqueueBlockEditorAssets(): void
    {
        $theme_version = wp_get_theme()->get('Version');
        $theme_uri     = get_template_directory_uri();

        // CSS
        //
        // Block editor style
        wp_enqueue_style(
            'bitski-wp-theme-block-editor-style',
            $theme_uri.'/assets/css/editor.css',
            [],
            $theme_version
        );
    }
}
