<?php
/**
 * The template component for displaying main menu social icon links.
 *
 * @since 0.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<ul class="main-menu-socials list-unstyled me-lg-2 mb-0 py-2 py-lg-0 d-flex align-items-center" role="group"
    aria-label="<?php esc_attr_e( 'Main menu socials', 'bitski-wp-theme' ); ?>">
    <li class="">
        <a class="github-link nav-link p-2 ps-0 ps-lg-2"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-github" aria-hidden="true"></i>
            <span class="d-lg-none"><?php esc_html_e( 'GitHub', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
    <li class="">
        <a class="x-twitter-link nav-link p-2"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
            <span class="d-lg-none"><?php esc_html_e( 'x.com', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
    <li class="">
        <a class="instagram-link nav-link p-2"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
            <span class="d-lg-none"><?php esc_html_e( 'Instagram', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
</ul>
