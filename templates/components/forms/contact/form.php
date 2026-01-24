<?php
/**
 * Template component for displaying a contact form.
 *
 * The template manages the display of the form depending on the form submission status and form validation.
 * Also displays form-related flash messages if available before the form.
 *
 * @since 0.8.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$is_submitted = false;
$is_valid     = true;

// Check for flash messages and display them if available.
if ( ! empty( $_SESSION['flash_messages'] ) ) {
    $is_submitted   = true;
    $flash_messages = $_SESSION['flash_messages'];

    foreach ( $flash_messages as $flash_message ) {
        $flash_message_type = $flash_message['type'];
        $flash_message_text = $flash_message['text'];

        // Set the form validation status based on the flash message type.
        if ( $flash_message_type === 'danger' ) {
            $is_valid = false;
        } ?>
        <div class="alert alert-<?php echo esc_attr( $flash_message_type ); ?>" role="alert">
            <?php echo esc_html__( $flash_message_text, 'bitski-wp-theme' ); ?>
        </div>
    <?php }
    unset( $_SESSION['flash_messages'] );
}

// Display the contact form only if it hasn't been submitted yet or if the form is invalid.
if ( ! $is_submitted || $is_valid === false ) { ?>
    <form method="post" class="contact-form" action="<?php echo esc_url( get_permalink() ); ?>">
        <?php wp_nonce_field( 'contact_form_submit', 'contact_form_nonce' ); ?>

        <div class="mb-3">
            <label for="contact-name" class="visually-hidden"><?php echo esc_html__( 'Name',
                        'bitski-wp-theme' ); ?></label>
            <input id="contact-name" class="contact-name-input form-control" name="contact_name" type="text"
                   placeholder="<?php echo esc_attr__( 'Dein Name', 'bitski-wp-theme' ); ?>" required>
            <div class="invalid-feedback"><?php echo esc_html__( 'Bitte gib deinen Namen ein', 'bitski-wp-theme' ); ?>
                .
            </div>
        </div>
        <div class="mb-3">
            <label for="contact-email" class="visually-hidden"><?php echo esc_html__( 'Email',
                        'bitski-wp-theme' ); ?></label>
            <input id="contact-email" class="contact-email-input form-control" name="contact_email" type="email"
                   placeholder="<?php echo esc_attr__( 'Deine Email-Adresse', 'bitski-wp-theme' ); ?>" required>
            <div class="invalid-feedback"><?php echo esc_html__( 'Bitte gib deine Email-Adresse ein',
                        'bitski-wp-theme' ); ?>.
            </div>
        </div>
        <div class="mb-3">
            <label for="contact-phone" class="visually-hidden"><?php echo esc_html__( 'Telefon',
                        'bitski-wp-theme' ); ?></label>
            <input id="contact-phone" class="contact-phone-input form-control" name="contact_phone" type="tel"
                   placeholder="<?php echo esc_attr__( 'Deine Telefonnummer', 'bitski-wp-theme' ); ?>"
                   style="position:absolute; left:-9999px;" aria-hidden="true"
                   autocomplete="off" tabindex="-1"/>
        </div>
        <div class="mb-3">
            <label for="contact-message" class="visually-hidden"><?php echo esc_html__( 'Nachricht',
                        'bitski-wp-theme' ); ?></label>
            <textarea id="contact-message" class="contact-message-textarea form-control" name="contact_message" rows="3"
                      placeholder="<?php echo esc_attr__( 'Deine Nachricht', 'bitski-wp-theme' ); ?>"
                      required></textarea>
            <div class="invalid-feedback"><?php echo esc_html__( 'Bitte gib deine Nachricht ein',
                        'bitski-wp-theme' ); ?>.
            </div>
        </div>
        <p class="form-text text-muted">
            <?php echo esc_html__( 'Mit dem Absenden des Formulars wird zugestimmt, dass die angegebenen Daten zur Bearbeitung der Anfrage
            verarbeitet werden', 'bitski-wp-theme' ); ?>.
            <?php echo esc_html__( 'Mehr Informationen dazu gibt es in der', 'bitski-wp-theme' ); ?>
            <a href="/datenschutz" target="_blank"
               rel="noopener noreferrer"><?php echo esc_html__( 'Datenschutzerklärung', 'bitski-wp-theme' ); ?><span
                        class="visually-hidden"><?php echo esc_html__( 'Öffnet in neuem Fenster',
                            'bitski-wp-theme' ); ?></span></a>.
            <?php echo esc_html__( 'Ein Widerruf ist jederzeit möglich', 'bitski-wp-theme' ); ?>.</p>
        <button class="contact-submit btn btn-primary" type="submit">
            <i class="fa-solid fa-paper-plane me-2" aria-hidden="true"></i>
            <?php echo esc_html__( 'Nachricht senden', 'bitski-wp-theme' ); ?>
        </button>
    </form>
<?php }
