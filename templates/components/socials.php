<?php
/**
 * The template component for displaying social icon links.
 *
 * @since 0.5.7
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$template             = $args['template'] ?? '';
$display_labels       = apply_filters( 'bitski-wp-theme/option/header/display-socials-labels', true );
$class_display_labels = '';

if ( $template === 'header' && $display_labels ) {
    $class_display_labels = 'd-lg-none';
}
?>

<ul class="socials list-unstyled me-lg-2 mb-0 py-2 py-lg-0 d-flex justify-content-lg-end align-items-center"
    role="group"
    aria-label="<?php esc_attr_e( 'Main menu socials', 'bitski-wp-theme' ); ?>">
    <li class="me-2">
        <a class="github-link nav-link p-2 ps-0"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-github" aria-hidden="true"></i>
            <?php if ( $display_labels ) { ?>
                <span class="<?php echo $class_display_labels; ?>"><?php esc_html_e( 'GitHub', 'bitski-wp-theme' ); ?></span>
            <?php } ?>
            <span class="visually-hidden"><?php esc_html_e( 'GitHub', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
    <li class="me-1">
        <a class="x-twitter-link nav-link p-2 ps-0"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
            <?php if ( $display_labels ) { ?>
                <span class="<?php echo $class_display_labels; ?>"><?php esc_html_e( 'x.com', 'bitski-wp-theme' ); ?></span>
            <?php } ?>
            <span class="visually-hidden"><?php esc_html_e( 'x.com', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
    <li class="me-2">
        <a class="instagram-link nav-link p-2 ps-0"
           href="<?php echo esc_url( wp_login_url() ); ?>">
            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
            <?php if ( $display_labels ) { ?>
                <span class="<?php echo $class_display_labels; ?>"><?php esc_html_e( 'Instagram', 'bitski-wp-theme' ); ?></span>
            <?php } ?>
            <span class="visually-hidden"><?php esc_html_e( 'Instagram', 'bitski-wp-theme' ); ?></span>
        </a>
    </li>
</ul>
