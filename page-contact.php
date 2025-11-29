<?php
/**
 * Template Name: Page Contact
 * Template for displaying a contact page.
 * Post type: page
 *
 * @since 0.8.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="content" class="content <?php echo esc_attr( apply_filters( 'bitski-wp-theme/class/container',
        ['container-xl'], true ) ); ?> pt-4 pb-5">
    <!-- Content header -->
    <header class="content-header mb-4">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <?php
    if ( apply_filters( 'bitski-wp-theme/option/forms/general/load', null ) ) { ?>
        <!-- Content body: contact form -->
        <?php get_template_part( 'templates/components/forms/contact/form' );
    } ?>
</main>

<?php get_footer(); ?>
