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
		$this->registerBaseHooks();         // Base hooks, support.
		$this->registerCssClassesHooks();   // CSS classes hooks.
		$this->registerOptionHooks();       // Theme options hooks.
		$this->registerFunctionalHooks();   // Functional hooks, e.g., JS events.
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
     * Getter for theme options by filter name.
     * Returns the option value or default value if not found.
     */
	public function getOptionByFilter( string $filter, string|bool $defaultOption = '' ): string|bool {
		if ( isset( ThemeSetup::$options[ $filter ] ) && ThemeSetup::$options[ $filter ] !== '' ) {
			$setupOption = ThemeSetup::$options[ $filter ];

			return is_bool($setupOption) ? $setupOption : (string) $setupOption;
		}

		return $defaultOption;
	}

	/*
	 * Registers base hooks.
	 */
	protected function registerBaseHooks() {}

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

	/*
	 * Registers hooks for theme options.
	 */
	protected function registerOptionHooks() {
		foreach (ThemeSetup::$options as $filter => $setupOption) {
			add_filter($filter, function ($defaultOption = '') use ($filter) {
				return $this->getOptionByFilter($filter, $defaultOption);
			});
		}
	}

	/*
	 * Registers hooks for functionalities.
	 */
	protected function registerFunctionalHooks() {
		add_action( 'wp_footer', [ $this, 'outputSvgSprite' ], 20 );
	}

	/*
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
