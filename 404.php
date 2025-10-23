<?php
/**
 * Template for displaying 404 pages (not found).
 * Post type: none assigned
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="content" class="content <?php echo apply_filters( 'bitski-wp-theme/class/container', 'container-xl' ); ?> pt-4 pb-5">
	<!-- Content header -->
	<header class="content-header mb-4">
		<h1 class="entry-title"><?php printf(esc_html__('404 – Fehler bei Aufruf der Seite: %s', 'bitski-wp-theme'), '<span class="text-body-secondary">' . esc_html( '/' . $wp->request ) . '</span>') ?></h1>
	</header>

	<?php get_template_part( 'templates/pages/search-404/content/no-results' ); ?>
</main>

<?php get_footer(); ?>
