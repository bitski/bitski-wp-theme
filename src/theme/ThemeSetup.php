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
	 */
	public static array $options = [
		// Example: 'option-name' => 'default-value'

		// Loading options
		'bitski-wp-theme/option/load-fontawesome'                  => true,
		'bitski-wp-theme/option/load-bootstrap-icons-sprite'       => false,

		// Header options
		'bitski-wp-theme/option/header/display-socials'            => true,
		'bitski-wp-theme/option/header/display-socials-labels'     => true,
		'bitski-wp-theme/option/header/display-search'             => true,

		// Footer options
		'bitski-wp-theme/option/footer/display-socials'            => true,
		'bitski-wp-theme/option/footer/contacts/display'           => true,
		'bitski-wp-theme/option/footer/contacts/display-labels'    => true,
		'bitski-wp-theme/option/footer/contacts/tel'               => '+1234567890',
		'bitski-wp-theme/option/footer/contacts/mail'              => 'info@example.com',


		// Single post options
		'bitski-wp-theme/option/single/meta/display-author'        => true,
		'bitski-wp-theme/option/single/meta/display-date'          => true,
		'bitski-wp-theme/option/single/meta/display-date-modified' => true,

		// Archive page options
		'bitski-wp-theme/option/card/meta/display-author'          => true,
		'bitski-wp-theme/option/card/meta/display-date'            => true,
		'bitski-wp-theme/option/card/meta/display-date-modified'   => true,

		// Pages options
		'bitski-wp-theme/option/pages/using-session/ids'           => [ 49 ], // [ 13, 232 ]

		// Forms options
		'bitski-wp-theme/option/forms/general/load'                => true,
		'bitski-wp-theme/option/forms/general/antispam-delay'      => 5,
		'bitski-wp-theme/option/forms/contact/recipient-email'     => 'info@example.com',
		'bitski-wp-theme/option/forms/contact/from-email'          => 'info@example.com',
		'bitski-wp-theme/option/forms/contact/from-name'           => 'Website Kontakt',

		// Add more option filters as needed
	];

	/*
	 * Centralized array to manage CSS classes for various theme components
	 * Key: filter name, Value: array of default classes
	 * Usage: apply_filters('filter-name', 'default-classes')
	 */
	public static array $classes = [
		// Example: 'filter-name' => [ 'class1', 'class2' ]
		'bitski-wp-theme/class/header'                   => [ 'sticky-top', 'bg-body-tertiary' ],
		'bitski-wp-theme/class/header/navbar/breakpoint' => [],
		'bitski-wp-theme/class/header/navbar/navbar-nav' => [ 'ms-auto', 'mb-2', 'mb-lg-0', 'me-lg-2' ],
		'bitski-wp-theme/class/container'                => [],
		// Add more class name filters as needed
	];

	/**
	 * Initialize theme setup
	 *
	 * Theme support features, textdomain loading,
	 * navigation menus registration, session start.
	 */
	public function init(): void {
		add_action( 'after_setup_theme', [ $this, 'themeSupport' ] );
		add_action( 'after_setup_theme', [ $this, 'loadTextdomain' ] );
		add_action( 'after_setup_theme', [ $this, 'registerNavMenus' ] );

		add_action( 'template_redirect', [ $this, 'startSession' ] );
	}

	/**
	 * Add theme support features.
	 */
	public function themeSupport(): void {
		// Core features
		add_theme_support( 'title-tag' );

		// Content features
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );

		// Block editor features
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );

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
	 * Load theme textdomain for translations.
	 */
	public function loadTextdomain(): void {
		load_theme_textdomain( 'bitski-wp-theme', get_template_directory() . '/languages' );
	}

	/**
	 * Register theme navigation menus.
	 */
	public function registerNavMenus(): void {
		register_nav_menus( [
			'main-menu'   => __( 'Main menu', 'bitski-wp-theme' ),
			'footer-menu' => __( 'Footer menu', 'bitski-wp-theme' ),
		] );
	}

	/**
	 * Start session if its not already started and
	 * if current page is in the option array of pages using sessions.
	 */
	public function startSession(): void {
		// Return early if session is already started.
		if ( session_id() ) {
			return;
		}

		// Security check if headers are already sent.
		// Return early if so, no session can be started.
		if ( headers_sent( $file, $line ) ) {
			error_log( "Session could not be started. Headers already sent in $file on line $line." );

			return;
		}

		// Check if current page is in the option array of pages using sessions.
		$pages_using_session_ids = apply_filters( 'bitski-wp-theme/option/pages/using-session/ids', [] );
		foreach ( $pages_using_session_ids as $id ) {
			if ( is_page( $id ) ) {
				session_start();
				break;
			}
		}
	}
}
