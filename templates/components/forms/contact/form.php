<?php
/**
 * Template component for displaying a contact form.
 *
 * @since 0.8.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<form method="post" class="contact-form" action="">
    <?php wp_nonce_field( 'contact_form', 'contact_form_nonce' ); ?>
    Form
</form>
