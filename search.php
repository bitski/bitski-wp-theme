<?php
/**
 * The template for displaying search results pages.
 * Post type: all
 *
 * @since 0.5.18
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Redirect if search is disabled.
if ( ! apply_filters( 'bitski-wp-theme/option/header/display-search', true ) ) {
    wp_redirect( home_url() );
    exit;
}

get_header();
?>

<main id="content" class="content <?php echo apply_filters( 'bitski-wp-theme/class/container', 'container-xl' ); ?> pt-4 pb-5">
    <!-- Content header -->
    <header class="content-header mb-4">
        <h1 class="entry-title"><?php printf(esc_html__('Suchergebnisse für: %s', 'bitski-wp-theme'), '<span class="text-body-secondary">' . get_search_query() . '</span>') ?></h1>
    </header>

    <?php
    if ( have_posts() ) {
        get_template_part( 'templates/pages/search/content/results' );
    } else {
        get_template_part( 'templates/pages/search/content/no-results' );
    }
    ?>
</main>

<?php get_footer(); ?>