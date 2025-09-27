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
<footer id="footer" class="footer bg-body-tertiary">
        <!-- Footer branding -->
        <?php get_template_part( 'templates/components/footer/branding' ); ?>

        <!-- Footer columns -->
        <?php get_template_part( 'templates/components/footer/columns' ); ?>

        <!-- Footer infos -->
        <?php get_template_part( 'templates/components/footer/info' ); ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
