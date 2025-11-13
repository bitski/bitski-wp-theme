<?php
/**
 * Template component for displaying footer branding.
 * Includes site branding and optional social icons.
 *
 * @since 0.5.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="footer-branding py-5">
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', [ 'container-xl' ], true ); ?>">
        <div class="row">
            <!-- Footer branding -->
            <div class="footer-branding col-12 col-md-8 align-items-lg-end">
                <a class="footer-branding-logo d-block mb-2" href="<?php echo esc_url( home_url() ); ?>"
                   aria-label="<?php echo esc_attr( 'Home', 'bitski-wp-theme' ); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bitski-wp-theme-logo_50x50.svg"
                         alt="<?php bloginfo( 'name' ); ?> Logo" class="logo logo-light d-inline-block align-middle"
                         loading="lazy">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bitski-wp-theme-logo-dark_50x50.svg"
                         alt="<?php bloginfo( 'name' ); ?> Logo" class="logo logo-dark d-inline-block align-middle"
                         loading="lazy">
                    <span class="visually-hidden"><?php bloginfo( 'name' ); ?></span>
                </a>
                <p class="footer-slogan mb-2">
                    <?php echo esc_html__( 'Branding slogan.', 'bitski-wp-theme' ); ?>
                </p>
            </div>

            <!-- Footer socials -->
            <?php
            if ( apply_filters( 'bitski-wp-theme/option/footer/show-socials', true ) ) { ?>
                <div class="footer-socials col-12 col-md-4 d-flex justify-content-md-end align-items-md-end">
                    <?php get_template_part( 'templates/components/socials' ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
