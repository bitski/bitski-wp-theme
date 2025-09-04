<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * The template for displaying the header
 *
 * @since 0.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Skip Links -->
<a class="skip-link visually-hidden-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'bitski-wp-theme' ); ?></a>
<a class="skip-link visually-hidden-focusable" href="#footer"><?php esc_html_e( 'Skip to footer', 'bitski-wp-theme' ); ?></a>

<header>
    Header
</header>
