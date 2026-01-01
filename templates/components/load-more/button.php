<?php
/**
 * Template component for displaying a load-more button.
 *
 * @since 0.11.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<button class="load-more btn btn-primary" type="button">
    <i class="fa-solid fa-plus me-2" aria-hidden="true"></i>
    <?php echo esc_html__( 'Mehr laden', 'bitski-wp-theme' ); ?>
</button>
