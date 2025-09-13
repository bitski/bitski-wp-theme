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

<main id="content" class="content <?php echo apply_filters( 'bitski-wp-theme/class/container', 'container' ); ?>">
    <!-- Content header -->
    <header class="">
        <h1 class="entry-title"><?php bloginfo( 'name' ); ?></h1>
        <p class=""><?php bloginfo( 'description' ); ?></p>
    </header>

    <!-- Post list -->
    <?php if ( have_posts() ) { ?>
        <section class="post-list">
            <div class="">
                <?php while ( have_posts() ) {
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>">
                        Post <?php the_ID(); ?>
                    </article>
                <?php } ?>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>
