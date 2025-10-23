<?php
/**
 * Template component for displaying the main navigation menu.
 *
 * @since 0.4.3
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_nav_menu( array(
	'theme_location' => 'main-menu',
	'container'      => false,
	'menu_class'     => '',
	'fallback_cb'    => '__return_false',
	'items_wrap'     => '<ul class="navbar-nav '. apply_filters('bitski-wp-theme/class/header/navbar/navbar-nav', 'ms-auto').'">%3$s</ul>',
	'depth'          => 2,
	'walker'         => new \BitskiWPTheme\walkers\NavWalker(),
) );
