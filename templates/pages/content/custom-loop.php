<?php
/**
 * Template component for displaying a custom loop within a page's content.
 * Included by the page.php template when a page is set to show a custom loop.
 *
 * @since 0.6.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_type    = 'post';
$args         = array(
        'post_type'      => $post_type,
        'posts_per_page' => 10,
);
$custom_query = new WP_Query( $args );
if ( $custom_query->have_posts() ) {
    $found_posts    = $custom_query->found_posts;
    $posts_per_page = get_option( 'posts_per_page' );
    while ( $custom_query->have_posts() ) {
        $custom_query->the_post(); ?>
        <div class="col-12<?php
        if ( $found_posts > 1 && $posts_per_page > 1 ) { ?>
            col-lg-6
        <?php } ?>">
            <?php get_template_part( 'templates/components/article/card' ); ?>
        </div>
    <?php }
    wp_reset_postdata();
} ?>
