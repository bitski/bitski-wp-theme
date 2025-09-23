<?php
/**
 * The template component for displaying main menu actions.
 *
 * @since 0.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="main-menu-actions me-lg-2 py-3 py-lg-0 d-flex align-items-center" role="group" aria-label="<?php esc_attr_e( 'Main menu actions', 'bitski-wp-theme' ); ?>">
    <!-- Color mode dropdown -->
    <div class="color-mode-dropdown dropdown">
        <button class="color-mode-toggler dropdown-toggle btn btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i>
            <span class="visually-hidden"><?php esc_html_e( 'Color mode toggler', 'bitski-wp-theme' ); ?></span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <button class="dropdown-item" data-bs-theme-value="light" aria-pressed="false">
                    <span class="color-mode-icon light"><i class="fa-solid fa-sun" aria-hidden="true"></i></span>
                    <span class="color-mode-description">Light</span>
                </button>
            </li>
            <li>
                <button class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                    <span class="color-mode-icon dark"><i class="fa-solid fa-moon" aria-hidden="true"></i></span>
                    <span class="color-mode-description">Dark</span>
                </button>
            </li>
            <li>
                <button class="dropdown-item active" data-bs-theme-value="auto" aria-pressed="false">
                    <span class="color-mode-icon auto"><i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i></span>
                    <span class="color-mode-description">Auto</span>
                </button>
            </li>
        </ul>
    </div>
</div>
