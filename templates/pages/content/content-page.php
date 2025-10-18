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

<!-- Content body: page content -->
<section class="content-body row">
    <div class="col-12">
        <article id="post-<?php the_ID(); ?>" class="position-relative">
            <?php if ( has_post_thumbnail() ) {
                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
                <header class="post-header">
                    <img class="img-fluid rounded mb-3" src="<?php echo esc_url( $thumbnail_url ); ?>"
                         alt="<?php the_title_attribute(); ?>" loading="lazy">
                </header>
            <?php } ?>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    </div>
</section>
