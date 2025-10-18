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
class AssetsManager
{
    public function init()
    {
        add_action('wp_enqueue_scripts', [ $this, 'enqueueAssets' ], 0);
    }

    public function enqueueAssets()
    {
        $theme_version = wp_get_theme()->get('Version');
        $theme_uri = get_template_directory_uri();

        // CSS
	    //
	    // Theme main style
        wp_enqueue_style(
            'bitski-wp-theme-style',
            $theme_uri . '/assets/css/main.css',
            [],
            $theme_version
        );

		// Fontawesome
	    if ( apply_filters( 'bitski-wp-theme/option/load-fontawesome', true ) ) {
		    wp_enqueue_style(
			    'fontawesome',
			    $theme_uri . '/assets/fonts/fontawesome/css/all.min.css',
			    [],
			    '7.0.1'
		    );
	    }

		// Scripts
	    //
	    // Enqueue the main theme script as an ES6 JavaScript module.
		// This will load main.js with the correct type="module" attribute,
		// enabling native module imports within main.js (e.g., importing theme.js, bootstrap.bundle.min.js).
	    // Requires WordPress 6.5 or higher for native wp_enqueue_script_module() support.
	    wp_enqueue_script_module(
		    'bitski-wp-theme-main-script',
		    $theme_uri . '/assets/js/main.js',
		    [],
		    $theme_version,
		    true
	    );
    }
}
