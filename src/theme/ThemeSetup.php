<?php
/**
 * Theme setup class.
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\theme;

class ThemeSetup {
	/*
	 * Centralized array to manage theme options.
	 * Key: option name, Value: option value
	 * Usage: apply_filters('option-name', 'default-value')
	 *
	 * @var array{
	 *   'bitski-wp-theme/option/load-fontawesome': bool,
	 * }
	 */
	public static array $options = [
		// Example: 'option-name' => 'default-value'
		'bitski-wp-theme/option/load-fontawesome' => true,
		'bitski-wp-theme/option/header/display-socials' => true,
		'bitski-wp-theme/option/header/display-socials-labels' => true,
		'bitski-wp-theme/option/footer/display-socials' => true,
		// Add more option filters as needed
	];

	/*
	 * Centralized array to manage CSS classes for various theme components
	 * Key: filter name, Value: array of default classes
	 * Usage: apply_filters('filter-name', 'default-classes')
	 */
	public static array $classes = [
		// Example: 'filter-name' => [ 'class1', 'class2' ]
		'bitski-wp-theme/class/header'                   => [ ],
		'bitski-wp-theme/class/header/navbar/breakpoint' => [ ],
		'bitski-wp-theme/class/header/navbar/navbar-nav' => [ 'ms-auto', 'mb-2', 'mb-lg-0', 'me-lg-2' ],
		'bitski-wp-theme/class/container'                => [ ],
		// Add more class name filters as needed
	];

	/*
	 * Initialize theme setup
	 * Theme support features and textdomain loading
	 */
	public function init()
    {
		add_action('after_setup_theme', [$this, 'themeSupport']);
        add_action('after_setup_theme', [$this, 'loadTextdomain']);
		add_action('after_setup_theme', [$this, 'registerNavMenus']);
    }

	// Add theme support features
	public function themeSupport()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
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
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
    }

	// Load theme textdomain for translations
    public function loadTextdomain()
    {
        load_theme_textdomain('bitski-wp-theme', get_template_directory() . '/languages');
    }

	// Register theme navigation menus
	public function registerNavMenus()
	{
		register_nav_menus([
			'main-menu' => __('Main menu', 'bitski-wp-theme'),
			'footer-menu' => __('Footer menu', 'bitski-wp-theme'),
		]);
	}
}
