<?php
/**
 * Template component for displaying a Bootstrap card for an article.
 * Included in loop templates to modularize the article display within lists.
 *
 * @since 0.6.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" class="position-relative card h-100">
    <?php if ( has_post_thumbnail() ) {
        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
        <img class="card-img-top" src="<?php echo esc_url( $thumbnail_url ); ?>"
             alt="<?php the_title_attribute(); ?>" loading="lazy">
    <?php } ?>
    <div class="card-body">
        <header class="post-header">
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
