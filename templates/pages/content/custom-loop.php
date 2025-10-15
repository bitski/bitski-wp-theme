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
    while ( $custom_query->have_posts() ) {
        $custom_query->the_post(); ?>
        <article id="post-<?php the_ID(); ?>" class="position-relative card h-100">
            <?php if ( has_post_thumbnail() ) {
                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
                <img class="card-img-top" src="<?php echo esc_url( $thumbnail_url ); ?>"
                     alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php } ?>
            <div class="article-body card-body">
                <header>
                    <h2 class="post-title card-title h5">
                        <a class="stretched-link text-reset text-decoration-none"
                           href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </header>
                <div class="post-content card-text">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </article>
    <?php }
    wp_reset_postdata();
} ?>