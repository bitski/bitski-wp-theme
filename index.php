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
    <?php if ( have_posts() ) {
        $found_posts = $wp_query->found_posts;
        $posts_per_page = get_option( 'posts_per_page' );
        ?>
        <section class="post-list row g-4<?php
        if ( paginate_links() ) {
            echo ' mb-4';
        } ?>">
            <?php
            while ( have_posts() ) {
                the_post(); ?>
                <div class="col-12<?php
                if ( $found_posts > 1 && $posts_per_page > 1 ) { ?>
                    col-lg-6
                <?php } ?>">
                    <?php get_template_part( 'templates/components/article/card' ); ?>
                </div>
            <?php } ?>
        </section>
        <?php
        get_template_part( 'templates/components/pagination' );
    } else { ?>
        <section class="no-posts">
            <header class="alert alert-primary mb-4">
                <h2><?php echo esc_html( 'Keine Beiträge gefunden!', 'bitski-wp-theme' ); ?></h2>
            </header>
            <div class="content">
                <p class="alert alert-info mb-4"><?php echo esc_html( 'Zurzeit sind keine Beiträge verfügbar. Bitte besuche uns später wieder oder nutze die Suche:',
                            'bitski-wp-theme' ); ?></p>
                <?php get_template_part( 'templates/components/search/form', null, array( 'class' => 'mb-4' ) ); ?>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>
