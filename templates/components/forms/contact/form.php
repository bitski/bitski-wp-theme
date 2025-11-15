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

if ( ! empty( $_SESSION['flash_message'] ) ) {
    $flash_message      = $_SESSION['flash_message'];
    $flash_message_type = $flash_message['type'];
    $flash_message_text = $flash_message['text'];
    ?>
    <div class="alert alert-<?php echo esc_attr( $flash_message_type ); ?>" role="alert">
        <?php echo esc_html__( $flash_message_text, 'bitski-wp-theme' ); ?>
    </div>
    <?php
    unset( $_SESSION['flash_message'] );
} else { ?>
    <form method="post" class="contact-form" action="<?php echo esc_url( get_permalink() ); ?>">
        <?php wp_nonce_field( 'contact_form_submit', 'contact_form_nonce' ); ?>

        <div class="mb-3">
            <label for="contact-name" class="visually-hidden">Name</label>
            <input id="contact-name" class="contact-name-input form-control" name="contact_name" type="text"
                   placeholder="Dein Name" required>
            <div class="invalid-feedback">Bitte gib deinen Namen ein.</div>
        </div>
        <div class="mb-3">
            <label for="contact-email" class="visually-hidden">Email</label>
            <input id="contact-email" class="contact-email-input form-control" name="contact_email" type="email"
                   placeholder="Deine Email-Adresse" required>
            <div class="invalid-feedback">Bitte gib deine Email-Adresse ein.</div>
        </div>
        <div class="mb-3">
            <label for="contact-message" class="visually-hidden">Nachricht</label>
            <textarea id="contact-message" class="contact-message-textarea form-control" name="contact_message" rows="3"
                      placeholder="Deine Nachricht" required></textarea>
            <div class="invalid-feedback">Bitte gib deine Nachricht ein.</div>
        </div>
        <p class="form-text text-muted">
            Mit dem Absenden des Formulars wird zugestimmt, dass die angegebenen Daten zur Bearbeitung der Anfrage
            verarbeitet werden. Mehr Informationen dazu gibt es in der <a href="/datenschutz" target="_blank"
                                                                          rel="noopener noreferrer">Datenschutzerklärung<span
                        class="visually-hidden"><?php echo esc_html__( 'Öffnet in neuem Fenster',
                            'bitski-wp-theme' ); ?></span></a>. Ein
            Widerruf ist jederzeit möglich.</p>
        <button class="contact-submit btn btn-primary" type="submit">
            <i class="fa-solid fa-paper-plane me-2" aria-hidden="true"></i>
            Nachricht senden
        </button>
    </form>
<?php }
