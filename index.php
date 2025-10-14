<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme.
 *
 * @package Bitski_WP_Theme
 * @since   0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="content" class="content <?php echo esc_attr( apply_filters( 'bitski-wp-theme/class/container',
        'container-xl' ) ); ?> pt-4 pb-5">
    <!-- Content header -->
    <header class="content-header mb-4">
        <h1 class="entry-title"><?php bloginfo( 'name' ); ?></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    </header>

    <!-- Post list -->
    <?php if ( have_posts() ) { ?>
        <section class="post-list row g-4<?php
        if ( paginate_links() ) {
            echo ' mb-4';
        } ?>">
            <?php
            while ( have_posts() ) {
                the_post(); ?>
                <div class="col-12 col-lg-6">
                    <article id="post-<?php the_ID(); ?>" class="position-relative card h-100">
                        <?php if ( has_post_thumbnail() ) {
                            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
                            <img class="card-img-top" src="<?php echo esc_url( $thumbnail_url ); ?>"
                                 alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php } ?>
                        <div class="card-body">
                            <header>
                                <h2 class="post-title card-title h5">
                                    <a class="stretched-link text-reset text-decoration-none"
                                       href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                            </header>
                            <div class="post-content card-text">
                                <p>
                                    <?php echo get_the_excerpt(); ?>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            <?php } ?>
        </section>
    <?php } ?>
    <?php get_template_part( 'templates/components/pagination' ); ?>
</main>

<?php get_footer(); ?>
