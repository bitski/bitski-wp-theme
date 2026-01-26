<?php
/**
 * Template for displaying the header.
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}
?>

<!doctype html>
<html <?php
language_attributes(); ?>>
<head>
    <meta charset="<?php
    bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    wp_head(); ?>
</head>
<body <?php
body_class(); ?>>

<?php
wp_body_open(); ?>

<!-- Skip Links -->
<a class="skip-link visually-hidden-focusable"
   href="#content"><?php
    echo esc_html__('Skip to content', 'bitski-wp-theme'); ?></a>
<a class="skip-link visually-hidden-focusable"
   href="#footer"><?php
    echo esc_html__('Skip to footer', 'bitski-wp-theme'); ?></a>

<header class="header <?php
echo apply_filters('bitski-wp-theme/class/header', ['text-dark'], false); ?>">
    <!-- Navbar -->
    <nav id="nav-main" class="navbar <?php
    echo apply_filters(
            'bitski-wp-theme/class/header/navbar/breakpoint',
            ['navbar-expand-lg'],
            true
    ); ?>">
        <div class="<?php
        echo esc_attr(
                apply_filters(
                        'bitski-wp-theme/class/container',
                        ['container-xl'],
                        true
                )
        ); ?>">
            <!-- Navbar Brand -->
            <a class="navbar-brand" href="<?php
            echo esc_url(home_url()); ?>">
                <img class="logo logo-light"
                     src="<?php
                     echo get_stylesheet_directory_uri(); ?>/assets/img/bitski-wp-theme-logo_30x30.svg"
                     alt="<?php
                     echo esc_attr(get_bloginfo('name')) ?> Logo" width="30" height="30"
                     loading="lazy">
                <img class="logo logo-dark"
                     src="<?php
                     echo get_stylesheet_directory_uri(); ?>/assets/img/bitski-wp-theme-logo-dark_30x30.svg"
                     alt="<?php
                     echo esc_attr(get_bloginfo('name')) ?> Logo" width="30" height="30"
                     loading="lazy">
                <span class="site-title visually-hidden"><?php
                    echo esc_html(get_bloginfo('name')); ?></span>
            </a>

            <!-- Offcanvas Navbar -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php
                        echo esc_html__(
                                'Menu',
                                'bitski-wp-theme'
                        ); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<?php
                    echo esc_attr__('Close', 'bitski-wp-theme'); ?>"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Main Menu -->
                    <?php
                    get_template_part('templates/components/header/main-menu/menu'); ?>

                    <!-- Main menu socials, labels hidden on screens >= lg -->
                    <?php
                    if (apply_filters('bitski-wp-theme/option/header/display-socials', true)) {
                        get_template_part(
                                'templates/components/socials',
                                null,
                                ['template' => 'header']
                        );
                    }
                    ?>

                    <!-- Main menu actions -->
                    <?php
                    get_template_part('templates/components/header/main-menu/actions'); ?>
                </div>
            </div>

            <!-- Header actions -->
            <?php
            get_template_part('templates/components/header/actions'); ?>
        </div>
    </nav>

    <!-- Collapsed search bar -->
    <?php
    if (apply_filters('bitski-wp-theme/option/header/display-search', true)) { ?>
        <div class="collapse search-bar" id="collapseSearchBar">
            <div class="<?php
            echo esc_attr(
                    apply_filters(
                            'bitski-wp-theme/class/container',
                            ['container-xl'],
                            true
                    )
            ); ?> py-2">
                <?php
                get_template_part('templates/components/search/form'); ?>            </div>
        </div>
    <?php
    } ?>
</header>
