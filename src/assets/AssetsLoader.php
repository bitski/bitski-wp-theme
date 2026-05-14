<?php
/**
 * Theme assets loader.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\assets;

use BitskiWPTheme\theme\Options;

class AssetsLoader
{
    /**
     * Initializes assets loader.
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
        $themeVersion = wp_get_theme()->get('Version');
        $themeUri     = get_template_directory_uri();
        $themeDir     = get_template_directory();

        // Determines main JS file, prefers minified version if available.
        $themeMainScript = file_exists($themeDir . '/assets/js/main.min.js') ? 'main.min.js' : 'main.js';

        // CSS
        //
        // Main theme CSS
        wp_enqueue_style(
            'bitski-wp-theme-style',
            $themeUri . '/assets/css/main.css',
            [],
            $themeVersion
        );

        // Optional Fontawesome
        if (Options::get('bitski-wp-theme/option/load-fontawesome')) {
            wp_enqueue_style(
                'fontawesome',
                $themeUri . '/assets/fonts/fontawesome/css/all.min.css',
                [],
                '7.0.1'
            );
        }

        // Scripts
        //
        // Bootstrap JS
        // Classic bundle for Data-API features.
        // Loads Bootstrap first so Data-API features are available globally.
        wp_enqueue_script(
            'bitski-wp-theme-bootstrap-script',
            $themeUri . '/assets/js/lib/bootstrap.bundle.min.js',
            [],
            'v5.3.8',
            true
        );

        // Main theme JS (ESM module)
        // Requires WordPress 6.5 or higher for native wp_enqueue_script_module() support.
        wp_enqueue_script_module(
            'bitski-wp-theme-main-script',
            $themeUri . '/assets/js/' . $themeMainScript,
            [],
            $themeVersion,
            [
                'in_footer' => true,
            ]
        );
    }

    /**
     * Enqueues block editor assets.
     *
     * @since 0.10.1
     */
    public function enqueueBlockEditorAssets(): void
    {
        $themeVersion = wp_get_theme()->get('Version');
        $themeUri     = get_template_directory_uri();

        // CSS
        //
        // Block editor style
        wp_enqueue_style(
            'bitski-wp-theme-block-editor-style',
            $themeUri . '/assets/css/editor.css',
            [],
            $themeVersion
        );
    }
}
