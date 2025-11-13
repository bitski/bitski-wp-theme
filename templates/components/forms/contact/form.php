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

    <div class="input-group mb-3">
        <label for="contact-name" class="visually-hidden">Name</label>
        <input id="contact-name" class="form-control" name="contact_name" type="text"  placeholder="Dein Name" required>
        <div class="invalid-feedback">Bitte gib deinen Namen ein.</div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        <i class="fa-solid fa-paper-plane me-2" aria-hidden="true"></i>
        Nachricht senden
    </button>
</form>
