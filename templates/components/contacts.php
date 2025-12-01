<?php
/**
 * Template component for displaying contact links.
 *
 * @since 0.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$display_labels = apply_filters( 'bitski-wp-theme/option/footer/contacts/display-labels', true );
$tel            = apply_filters( 'bitski-wp-theme/option/footer/contacts/tel', '+1234567890' );
$mail           = apply_filters( 'bitski-wp-theme/option/footer/contacts/mail', 'info@example.com' );

$tel_href = preg_replace( '/[^0-9+]/', '', $tel );
?>

<ul class="contacts list-unstyled mb-0 d-flex gap-2"
    role="group"
    aria-label="<?php echo esc_attr__( 'Main menu contacts', 'bitski-wp-theme' ); ?>">
    <?php if ( ! empty( $tel ) ) { ?>
        <li>
            <a class="tel-link nav-link px-1 py-1 py-md-0"
               href="tel:<?php echo esc_attr( $tel_href ); ?>">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                <?php if ( $display_labels ) { ?>
                    <span><?php echo esc_html( $tel ); ?></span>
                <?php } ?>
                <span class="visually-hidden"><?php echo esc_html( $tel ); ?></span>
            </a>
        </li>
    <?php }
    if ( ! empty( $mail ) ) { ?>
        <li>
            <a class="mail-link nav-link px-1 py-1 py-md-0"
               href="mailto:<?php echo esc_attr( antispambot( $mail ) ); ?>">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                <?php if ( $display_labels ) { ?>
                    <span><?php echo esc_html( antispambot( $mail ) ); ?></span>
                <?php } ?>
                <span class="visually-hidden"><?php echo esc_html( antispambot( $mail ) ); ?></span>
            </a>
        </li>
    <?php } ?>
</ul>
