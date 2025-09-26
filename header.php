<?php
/**
 * The template for displaying the header.
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
        <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', 'container-xl' ); ?>">
            <!-- Navbar Brand -->
            <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bitski-wp-theme-logo_50x50.svg"
                     alt="<?php bloginfo( 'name' ); ?> Logo" class="d-td-none">
                <!--                <img src="" alt="--><?php //bloginfo( 'name' ); ?><!-- Logo" class="d-tl-none">-->
            </a>

            <!-- Offcanvas Navbar -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Main Menu -->
                    <?php get_template_part( 'templates/components/header/main-menu/menu' ); ?>

                    <!-- Main menu socials -->
                    <?php
                    if ( apply_filters('bitski-wp-theme/option/header/show-socials', true) ) {
                        get_template_part( 'templates/components/socials' );
                    }
                    ?>

                    <!-- Main menu actions -->
                    <?php get_template_part( 'templates/components/header/main-menu/actions' ); ?>
                </div>
            </div>

            <!-- Header actions -->
            <?php get_template_part( 'templates/components/header/actions' ); ?>
        </div>
    </nav>
</header>
