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
        // Bootstrap JS
	    wp_enqueue_script(
		    'bootstrap',
		    $theme_uri . '/assets/js/lib/bootstrap.bundle.min.js',
		    [],
		    '5.3.8',
		    true
	    );

		// Theme core script
	    wp_enqueue_script(
		    'bitski-wp-theme-core-script',
		    $theme_uri . '/assets/js/theme.js',
		    [],
		    $theme_version,
		    true
	    );

	    // Theme main script
	    wp_enqueue_script(
		    'bitski-wp-theme-main-script',
		    $theme_uri . '/assets/js/main.js',
		    [ 'bitski-wp-theme-core-script' ],
		    $theme_version,
		    true
	    );
    }
}
