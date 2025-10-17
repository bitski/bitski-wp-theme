<?php
/**
 * Template component for displaying the content within a page's content.
 * Included by the page.php template by default.
 *
 * @since 0.6.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="col-12">
    <article id=" post-<?php the_ID(); ?>" class="position-relative">
        <?php if ( has_post_thumbnail() ) {
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
            <img class="img-fluid rounded mb-3" src="<?php echo esc_url( $thumbnail_url ); ?>"
                 alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php } ?>
        <div class="article-body">
            <header>
                <h2 class="post-title h5">
                    <a class="stretched-link text-reset text-decoration-none"
                       href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </header>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
</div>
