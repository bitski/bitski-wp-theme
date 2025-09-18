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
     aria-label="<?php esc_attr_e( 'Header Actions', 'bitski-wp-theme' ); ?>">
    <!-- Search form -->
    <form class="d-flex me-1 me-md-2" role="search">
        <!--        <input class="form-control me-2" type="search" placeholder="Suche" aria-label="Suche">-->
        <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-search">Suche</i>
        </button>
    </form>

    <!-- Login button -->
    <a class="btn btn-sm btn-outline-primary me-1 me-md-2" href="<?php echo esc_url( wp_login_url() ); ?>">
        <?php esc_html_e( 'Login', 'bitski-wp-theme' ); ?>
    </a>

    <!-- Navbar toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>
