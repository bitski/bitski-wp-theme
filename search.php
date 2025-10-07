<?php
/**
 * The template for displaying search results pages.
 *
 * @since 0.5.18
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Redirect if search is disabled.
if (! apply_filters('bitski-wp-theme/option/header/display-search', true)) {
    wp_redirect( home_url() );
    exit;
}

get_header();
?>

<div>search.php</div>

<?php get_footer(); ?>