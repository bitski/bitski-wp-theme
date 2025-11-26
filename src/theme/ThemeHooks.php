<?php
/**
 * Theme hooks manager.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\theme;

/**
 * Manages theme hooks.
 *
 * @since 0.1.0
 */
class ThemeHooks {
	/**
	 * Initialize theme hooks.
	 * Registers all hooks.
	 */
	public function init() {
		$this->registerBaseHooks();         // Base hooks, support.
		$this->registerCssClassesHooks();   // CSS classes hooks.
		$this->registerOptionHooks();       // Theme options hooks.
		$this->registerFunctionalHooks();   // Functional hooks, e.g., JS events.
	}

	/**
	 * Getter for CSS classes by filter name.
	 * Returns a space-separated string of classes.
	 * Merges setup classes with default classes if $merge is true.
	 * Otherwise, returns default classes only.
	 *
	 * @param string $filter
	 * @param array $defaultClasses
	 * @param bool $merge
	 * @return string
	 */
	public function getClassesByFilter( string $filter, array $defaultClasses = [], bool $merge = true ): string {
		// Get setup classes if they're set and not empty.
		$setupClasses = [];
		if ( isset( ThemeSetup::$classes[ $filter ] ) && ! empty( ThemeSetup::$classes[ $filter ] ) ) {
			$setupClasses = ThemeSetup::$classes[ $filter ];
		}

		// Ensure $defaultClasses is an array.
		if ( ! is_array( $defaultClasses ) ) {
			$defaultClasses = [];
		}

		// If $merge parameter is set to true, merge setup classes with default classes.
		// Return merged classes as a space-separated string.
		if ( $merge ) {
			$merged_classes = array_filter( array_unique( array_merge( $setupClasses, $defaultClasses ) ) );

			return implode( ' ', $merged_classes );
		}

		// Return default classes only as a space-separated string.
		return implode( ' ', $defaultClasses );
	}

	/**
     * Getter for theme options by filter name.
     * Returns the default option if it is explicitly set (not null) and valid.
	 * Otherwise, checks global ThemeSetup options.
	 *
	 * @param string $filter
	 * @param mixed $defaultOption (default: null, for fallback to global setup option)
	 * @return mixed
     */
	public function getOptionByFilter( string $filter, mixed $defaultOption = null ): mixed {
		// Return default option if it is explicitly set (not null).
		// Return default option if it is boolean,
		// or if it is set and and neither an empty string nor an empty array.
		if ( is_bool( $defaultOption )
		     || ( isset( $defaultOption )
		          && $defaultOption !== ''
		          && ! ( is_array( $defaultOption ) && empty( $defaultOption ) ) ) ) {
			return $defaultOption;
		}

		// Return setup option if it's set and not empty.
		if ( isset( ThemeSetup::$options[ $filter ] ) && ThemeSetup::$options[ $filter ] !== '' ) {
			$setupOption = ThemeSetup::$options[ $filter ];

			if ( is_array( $setupOption ) || is_bool( $setupOption )) {
				return $setupOption;
			}

			return (string) $setupOption;
		}

		// Return default option as fallback.
		return $defaultOption;
	}

	/**
	 * Registers base hooks.
	 */
	protected function registerBaseHooks() {
	}

	/**
	 * Registers hooks for CSS classes.
	 */
	protected function registerCssClassesHooks() {
		foreach ( ThemeSetup::$classes as $filter => $setupClasses ) {
			add_filter( $filter, function ( $defaultClasses = '', $merge = true ) use ( $filter ) {
				// Returns classes as a space-separated string.
				return $this->getClassesByFilter( $filter, $defaultClasses, $merge );
			}, 10, 2 );
		}
	}

	/**
	 * Registers hooks for theme options.
	 */
	protected function registerOptionHooks() {
		foreach ( ThemeSetup::$options as $filter => $setupOption ) {
			add_filter( $filter, function ( $defaultOption = null ) use ( $filter ) {
				// Returns the option value or the default option if set.
				return $this->getOptionByFilter( $filter, $defaultOption );
			} );
		}
	}

	/**
	 * Registers hooks for functionalities.
	 */
	protected function registerFunctionalHooks() {
		// Header hooks
		// (To be inhabited)

		// Page hooks
		// (To be inhabited)

		// Footer hooks
		//add_action( 'wp_footer', [ $this, 'outputSvgSprite' ], 20 );
	}

	/**
	 * Outputs Bootstrap icons SVG sprite in the footer.
	 * Applies filter to enable/disable the sprite output.
	 * Ensures the sprite file exists before outputting its content.
	 */
	public function outputSvgSprite(): void {
		if ( apply_filters( 'bitski-wp-theme/option/load-bootstrap-icons-sprite', true ) ) {
			$spritePath = get_template_directory() . '/assets/svg/bootstrap-icons.svg';
			if ( file_exists( $spritePath ) ) {
				echo file_get_contents( $spritePath );
			}
		}
	}
}
