<?php
/**
 * The template for displaying pages.
 *
 * @since 0.1.0
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
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <?php
    if ( ! is_page( 33 ) ) {
        get_template_part( 'templates/pages/content/content-page' );
    } else {
        get_template_part( 'templates/pages/content/custom-loop' );
    } ?>
</main>

<?php get_footer(); ?>
