<?php
/**
 * Template component for displaying header actions.
 *
 * @since 0.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="header-actions d-flex align-items-center" role="group"
     aria-label="<?php echo esc_attr__( 'Header actions', 'bitski-wp-theme' ); ?>">
    <!-- Search bar toggler -->
    <?php
    if ( apply_filters( 'bitski-wp-theme/option/header/display-search', true ) ) { ?>
        <button class="search-bar-toggler me-1 me-md-2 btn btn-outline-secondary" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseSearchBar" aria-expanded="false" aria-controls="collapseSearchBar"
                aria-label="Toggle search bar">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </button>
    <?php } ?>

    <!-- Login link -->
    <a class="login-link btn btn-outline-secondary me-1 me-md-2 me-lg-0" href="<?php echo esc_url( wp_login_url() ); ?>" aria-label="Login">
        <i class="fa-solid fa-user" aria-hidden="true"></i>
    </a>

    <!-- Offcanvas navbar toggler -->
    <button class="offcanvas-navbar-toggler d-lg-none btn btn-secondary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>
</div>
