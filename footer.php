<?php
/**
 * Template for displaying the footer.
 *
 * @since 0.1.0
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}
?>
<footer id="footer" class="footer bg-body-tertiary">
    <!-- Footer branding -->
    <?php
    get_template_part('templates/components/footer/branding'); ?>

    <!-- Footer columns -->
    <?php
    get_template_part('templates/components/footer/columns'); ?>

    <!-- Footer bottom -->
    <?php
    get_template_part('templates/components/footer/bottom'); ?>
    </div>
</footer>

<?php
wp_footer(); ?>

</body>
