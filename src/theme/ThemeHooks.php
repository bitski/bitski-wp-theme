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
	public function getClassesByFilter( string $filter, string $defaultClasses = '' ): string {
		if ( isset( ThemeSetup::$classes[ $filter ] ) && !empty(ThemeSetup::$classes[ $filter ])) {
			$setupClasses = ThemeSetup::$classes[ $filter ];

			return is_array( $setupClasses ) ? implode( ' ', $setupClasses ) : (string) $setupClasses;
		}

		return $defaultClasses;
	}

	/*
	 * Registers hooks for CSS classes.
	 * Applies filters to return only classes without context.
	 */
	protected function registerCssClassesHooks() {
		foreach ( ThemeSetup::$classes as $filter => $setupClasses ) {
			add_filter( $filter, function ( $defaultClasses = '' ) use ( $filter ) {
				// Returns setup classes or default classes if none are set.
				return $this->getClassesByFilter( $filter, $defaultClasses );
			} );
		}
	}
}
