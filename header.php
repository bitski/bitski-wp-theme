<?php
/**
 * The template for displaying the header
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Skip Links -->
<a class="skip-link visually-hidden-focusable"
   href="#content"><?php esc_html_e( 'Skip to content', 'bitski-wp-theme' ); ?></a>
<a class="skip-link visually-hidden-focusable"
   href="#footer"><?php esc_html_e( 'Skip to footer', 'bitski-wp-theme' ); ?></a>

<header class="header">
    Header
    <nav id="nav-main" class="navbar <?php apply_filters('bitski-wp-them/class/header/navbar/breakpoint', 'navbar-expand-lg'); ?>">
        Navbar
        <?php var_dump(BITSKI_WP_THEME_CLASS_HEADER_NAVBAR_BREAKPOINT); ?>
    </nav>
    /Header
</header>
