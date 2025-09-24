<?php
/**
 * The template component for displaying header actions.
 *
 * @since 0.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="header-actions d-flex align-items-center" role="group"
     aria-label="<?php esc_attr_e( 'Header actions', 'bitski-wp-theme' ); ?>">
    <!-- Search form -->
    <form class="search-form d-flex me-1 me-md-2" role="search">
        <button class="search-toggler btn btn-outline-secondary" type="submit">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            <span class="visually-hidden"><?php esc_html_e( 'Search', 'bitski-wp-theme' ); ?></span>
        </button>
    </form>

    <!-- Login link -->
    <a class="login-link btn btn-outline-secondary me-1 me-md-2 me-lg-0" href="<?php echo esc_url( wp_login_url() ); ?>">
        <i class="fa-solid fa-user" aria-hidden="true"></i>
        <span class="visually-hidden"><?php esc_html_e( 'Login', 'bitski-wp-theme' ); ?></span>
    </a>

    <!-- Offcanvas navbar toggler -->
    <button class="offcanvas-navbar-toggler d-lg-none btn btn-secondary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
        <span class="visually-hidden"><?php esc_html_e( 'Menu', 'bitski-wp-theme' ); ?></span>
    </button>
</div>
