<?php
/**
 * Template component for displaying the bottom row of the footer.
 * Includes legal info and contact links (optional).
 *
 * @since 0.9.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$display_contacts = apply_filters( 'bitski-wp-theme/option/footer/contacts/display', null );
?>

<section class="footer-bottom py-2 border-top">
    <div class="<?php echo apply_filters( 'bitski-wp-theme/class/container', [ 'container-xl' ], true ); ?>">
        <div class="row">
            <!-- Footer legal info -->
            <div class="footer-info col-12 <?php if ( $display_contacts ) { ?>col-md-6<?php } ?>">
                <p class="mb-0 d-flex justify-content-center <?php if ( $display_contacts ) { ?>justify-content-md-end <?php } ?>align-items-center">
                    <small>&copy; 2025 &ndash; <?php
                        echo date( "Y" ) . ' ';
                        bloginfo( 'name' );
                        ?>
                    </small>
                </p>
            </div>

            <!-- Footer contact links (optional) -->
            <?php if ( $display_contacts ) { ?>
                <div class="footer-contacts col-12 col-md-6 d-flex justify-content-center justify-content-md-start small">
                    <?php get_template_part( 'templates/components/contacts' ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
