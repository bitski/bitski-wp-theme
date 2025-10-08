<?php
/**
 * Theme Helpers.
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\theme;

/**
 * Manages theme helpers.
 *
 * @since 0.1.0
 */
class ThemeHelpers
{
    /**
     * Getter for SVG icon markup.
     * Returns SVG element with <use> referencing the icon.
     *
     * @since 0.5.22
     * @return string
     */
	public static function getSvgIcon( string $iconName, array $args = [] ): string {
		$class = 'icon icon-' . esc_attr( $iconName ) . ( ! empty( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '' );

		// Fixed default size to 16x16, can be overridden via args.
		$width  = ! empty( $args['width'] ) ? intval( $args['width'] ) : 16;
		$height = ! empty( $args['height'] ) ? intval( $args['height'] ) : 16;

		// Return SVG element with <use> referencing the icon.
		return '<svg class="' . esc_attr( $class ) . '" width="' . $width . '" height="' . $height . '" aria-hidden="true" focusable="false" role="img">'
		       . '<use href="#icon-' . esc_attr( $iconName ) . '"></use>'
		       . '</svg>';
	}
}
