<?php
/**
 * The template for displaying the header
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Skip Links -->
<a class="skip-link visually-hidden-focusable"
   href="#content"><?php esc_html_e( 'Skip to content', 'bitski-wp-theme' ); ?></a>
<a class="skip-link visually-hidden-focusable"
   href="#footer"><?php esc_html_e( 'Skip to footer', 'bitski-wp-theme' ); ?></a>

<header class="header <?php echo apply_filters( 'bitski-wp-theme/class/header', 'bg-body-tertiary' ); ?>">
    <nav id="nav-main" class="navbar <?php echo apply_filters( 'bitski-wp-theme/class/header/navbar/breakpoint',
            'navbar-expand-lg' ); ?>">
        <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container' ); ?>">
            <!-- Navbar Brand -->
            <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
                <img src="" alt="<?php bloginfo( 'name' ); ?> Logo" class="d-td-none">
                <img src="" alt="<?php bloginfo( 'name' ); ?> Logo" class="d-tl-none">
            </a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Navbar -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php get_template_part( 'templates/components/main-menu' ); ?>
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
