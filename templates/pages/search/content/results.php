<?php
/**
 * The template component for displaying the search results loop.
 * Used by the search.php template when posts are found.
 *
 * @since 0.5.21
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="search results" aria-labelledby="search-results-heading">
    <header class="alert alert-success mb-4">
        <h2 id="search-results-heading">
            <?php
            // Build the search results found message with proper pluralization.
            printf(
                    esc_html(
                            _n(
                                    '%d Treffer gefunden',
                                    '%d Treffer gefunden',
                                    $wp_query->found_posts,
                                    'bitski-wp-theme'
                            )
                    ),
                    $wp_query->found_posts
            );
            ?>
        </h2>
    </header>
    <div class="content row g-4<?php
    if ( paginate_links() ) {
        echo ' mb-4';
    } ?>">
        <?php
        while ( have_posts() ) {
            the_post(); ?>
            <div class="col-12 col-lg-6">
                <article id="post-<?php the_ID(); ?>" class="position-relative card h-100">
                    <?php if ( has_post_thumbnail()) {
                        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
                        <img class="card-img-top" src="<?php echo esc_url( $thumbnail_url ); ?>"
                             alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php } ?>
                    <div class="article-body card-body">
                        <header>
                            <h3 class="post-title card-title h5">
                                <a class="stretched-link text-reset text-decoration-none"
                                   href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </header>
                        <div class="post-content card-text">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            </div>
        <?php } ?>
    </div>
    <?php get_template_part( 'templates/components/pagination' ); ?>
</section>
