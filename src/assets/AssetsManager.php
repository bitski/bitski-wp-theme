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

		//
	    wp_enqueue_style(
//		    'bootstrap',
//		    $theme_uri . '/assets/js/style.css',
//		    [],
//		    $theme_version
	    );

        // CSS
        wp_enqueue_style(
            'bitski-theme-style',
            $theme_uri . '/assets/css/style.css',
            [],
            $theme_version
        );

        // Bootstrap JS
	    wp_enqueue_script(
		    'bootstrap',
		    $theme_uri . '/assets/js/lib/bootstrap.bundle.min.js',
		    [],
		    $theme_version,
		    true
	    );


	    wp_enqueue_script(
            'bitski-theme-main',
            $theme_uri . '/assets/js/main.js',
            [],
            $theme_version,
            true
        );    
    }
}
