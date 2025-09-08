<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 *
 * @package Bitski_WP_Theme
 * @since   0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php get_header(); ?>

<main id="content" class="content">
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container' ); ?>">
        Main content
    </div>
</main>

<?php get_footer(); ?>
