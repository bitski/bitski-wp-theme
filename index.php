<?php
/**
 * Main template file.
 *
 * This is the most generic template file in a WordPress theme.
 * Post type: all
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
        [ 'container-xl' ], true ) ); ?> pt-4 pb-5">
    <!-- Content header -->
    <header class="content-header mb-4">
        <h1 class="post-title"><?php bloginfo( 'name' ); ?></h1>
        <p class="site-description"><?php bloginfo( 'description' ); ?></p>
    </header>

    <?php get_template_part( 'templates/pages/archive/loop' ); ?>
</main>

<?php get_footer(); ?>
