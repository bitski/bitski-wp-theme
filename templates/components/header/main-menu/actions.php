<?php
/**
 * Template component for displaying main menu actions.
 *
 * @since 0.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="main-menu-actions me-lg-2 py-3 py-lg-0 d-flex align-items-center" role="group" aria-label="<?php echo esc_attr( 'Main menu actions', 'bitski-wp-theme' ); ?>">
    <!-- Color theme dropdown -->
    <div class="color-theme-dropdown dropdown">
        <button id="color-theme-switcher" class="color-theme-switcher dropdown-toggle btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="<?php echo esc_attr( 'Toggle color theme', 'bitski-wp-theme' ); ?> ()">
            <i class="icon-active-theme fa-solid fa-circle-half-stroke" aria-hidden="true"></i>
            <span class="visually-hidden"><?php echo esc_html__( 'Toggle color theme', 'bitski-wp-theme' ); ?></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <button class="dropdown-item" data-bs-theme-value="light" aria-pressed="false">
                    <span class="color-theme-icon light"><i class="fa-solid fa-sun" aria-hidden="true"></i></span>
                    <span class="color-theme-description"><?php echo esc_html__('Light', 'bitski-wp-theme'); ?></span>
                </button>
            </li>
            <li>
                <button class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                    <span class="color-theme-icon dark"><i class="fa-solid fa-moon" aria-hidden="true"></i></span>
                    <span class="color-theme-description"><?php echo esc_html__('Dark', 'bitski-wp-theme'); ?></span>
                </button>
            </li>
            <li>
                <button class="dropdown-item active" data-bs-theme-value="auto" aria-pressed="false">
                    <span class="color-theme-icon auto"><i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i></span>
                    <span class="color-theme-description"><?php echo esc_html__('Auto', 'bitski-wp-theme'); ?></span>
                </button>
            </li>
        </ul>
    </div>
</div>
