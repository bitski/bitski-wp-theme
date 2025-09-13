<?php
/**
 * The template for displaying the footer.
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer id="footer" class="footer">
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container' ); ?>">
        Footer container
    </div>
</footer>

<?php wp_footer(); ?>

</body>
