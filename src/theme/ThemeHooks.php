<?php
/**
 * Theme hooks manager.
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\theme;

use BitskiWPTheme\assets\AssetsManager;

/**
 * Manages theme hooks.
 *
 * @since 0.1.0
 */
class ThemeHooks
{
    public function init()
    {
        $this->registerCssClassHooks();
		//add_action('init', [Assets::class, 'customCallback'], 0);
    }

	protected function registerCssClassHooks() {
		add_filter('bitski-wp-theme/class/header/navbar/breakpoint', [$this, 'navbarBreakpointClass']);
	}

	public function navbarBreakpointClass($default) {
		return BITSKI_WP_THEME_CLASS_HEADER_NAVBAR_BREAKPOINT;
	}
}
