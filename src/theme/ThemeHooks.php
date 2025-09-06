<?php
/**
 * Theme hooks manager.
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\theme;

use BitskiWPTheme\theme\ThemeSetup;
use BitskiWPTheme\assets\AssetsManager;

/**
 * Manages theme hooks.
 *
 * @since 0.1.0
 */
class ThemeHooks {
	// Initialize theme hooks.
	public function init() {
		$this->registerCssClassesHooks();
	}

	/*
	 * Getter for CSS classes by filter name.
	 * Returns a space-separated string of classes or default string if not found.
	 */
	public function getClassesByFilter( string $filter, string $default = '' ): string {
		if ( isset( ThemeSetup::$classes[ $filter ] ) ) {
			$classes = ThemeSetup::$classes[ $filter ];

			return is_array( $classes ) ? implode( ' ', $classes ) : (string) $classes;
		}

		return $default;
	}

	/*
	 * Registers hooks for CSS classes.
	 * Applies filters to return only classes without context.
	 */
	protected function registerCssClassesHooks() {
		foreach ( ThemeSetup::$classes as $filter => $defaultClasses ) {
			add_filter( $filter, function ( $classes = '' ) use ( $filter, $defaultClasses ) {
				// Returns default classes if none are provided, no context.
				return $this->getClassesByFilter( $filter, $classes );
			} );
		}
	}
}
