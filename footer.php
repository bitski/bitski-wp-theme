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
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container-xl' ); ?>">
        <!-- Footer socials -->
        <?php
        if ( apply_filters( 'bitski-wp-theme/option/footer/show-socials', true ) ) { ?>
            <section class="footer-socials row">
                <div class="col-12">
                    <?php get_template_part( 'templates/components/socials' ); ?>
                </div>
            </section>
        <?php } ?>

        <!-- Footer columns -->
        <?php get_template_part( 'templates/components/footer/columns' ); ?>

        <!-- Footer infos -->
        <?php get_template_part( 'templates/components/footer/info' ); ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
