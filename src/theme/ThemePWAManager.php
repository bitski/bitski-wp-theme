<?php
/**
 * Theme PWA manager.
 * Handles Progressive Web App (PWA) features for the theme.
 *
 * @since 0.16.0
 */

namespace BitskiWPTheme\theme;

class ThemePWAManager
{
    /**
     * Initialize the PWA manager.
     */
    public function init(): void
    {
        add_action('wp_head', [$this, 'registerPWAManifest']);
    }

    /**
     * Register the PWA manifest link in the head.
     */
    public function registerPWAManifest(): void
    {
        $manifestUrl = get_template_directory_uri().'/manifest.json';
        $themeColor  = '#0d6efd';
        echo '<link rel="manifest" href="'.esc_url($manifestUrl).'">';
        echo '<meta name="theme-color" content="'.esc_attr($themeColor).'">';
    }
}
