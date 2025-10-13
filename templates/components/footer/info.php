<?php
/**
 * The template component for displaying footer info.
 *
 * @since 0.5.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="footer-info py-2 border-top">
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container-xl' ); ?>">
        <p class="mb-0 text-center">
            <small>&copy; 2025 &ndash; <?php
                echo date( "Y" ) . ' ';
                bloginfo('name');
                ?>
            </small>
        </p>
    </div>
</section>
