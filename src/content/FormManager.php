<?php
/**
 * Manages theme forms.
 *
 * Handles form submission and validation for the contact page.
 * Sanitizes form data using WordPress sanitization functions.
 * Sets flash messages in the session for displaying messages on the page.
 * Redirects back to the contact page if the form is invalid.
 * Sends an email with the form data using WordPress' wp_mail function.
 *
 * @since 0.8.0
 */

namespace BitskiWPTheme\content;

class FormManager {
	/*
	 * Sanitized form data storage.
	 *
	 * @since 0.8.12
	 */
	protected array $sanitized_form_data = [];

	/**
	 * Initialize form manager.
	 * Registers hooks and initializes form processing actions.
	 */
	public function init(): void {
		add_action( 'template_redirect', [ $this, 'setFormContactLoadTime' ] );
		add_action( 'template_redirect', [ $this, 'processFormContact' ] );
	}

	/**
	 * Set form contact load time in the session.
	 * Returns early if the current request is not a GET request or not for the contact page.
	 * Sets the form contact load time in the session.
	 *
	 * @return void
	 * @since 0.8.20
	 */
	public function setFormContactLoadTime(): void {
		// Return early if not a GET request or not on the contact page.
		if ( $_SERVER['REQUEST_METHOD'] !== 'GET' || ! is_page( 'kontakt' ) ) {
			return;
		}

		$_SESSION['form_contact_load_time'] = time();
	}

	/**
	 * Process form submission for the contact page.
	 * Returns early if the current request is not a POST request or not for the contact page.
	 * Redirects back to the contact page if the form was submitted less than 5 seconds ago.
	 * Verifies the nonce for the form submission.
	 * Sanitizes form data using WordPress sanitization functions.
	 * Validates form data using custom validation functions.
	 * Redirects back to the contact page if the form is invalid.
	 * Sends an email with the form data using WordPress' wp_mail function.
	 */
	public function processFormContact(): void {
		// Return early if not a POST request (no form submission) or not on the contact page.
		if ( empty( $_POST ) || ! is_page( 'kontakt' ) ) {
			return;
		}

		// Anti-spam: Time-based check.
		// To protect against bots.
		// If the form was submitted less than 5 seconds ago, redirect back to the contact page.
		$forms_antispam_delay = apply_filters( 'bitski-wp-theme/option/forms/general/antispam-delay', null );

		if ( isset( $_SESSION['form_contact_load_time'] ) &&
		     ( time() - $_SESSION['form_contact_load_time'] ) < $forms_antispam_delay ) {
			$this->setFlashMessages(
				sprintf( __( 'Fehler: Bitte warten Sie %s Sekunden, bevor Sie das Formular erneut senden.',
					'bitski-wp-theme' ), $forms_antispam_delay ), 'danger' );
			wp_redirect( get_permalink() );
			exit;
		}

		// Honeypot field check.
		// To protect against bots.
		// If the hidden field 'contact_phone' is filled, treat it as spam.
		if ( ! empty( $_POST['contact_phone'] ) ) {
			$this->setFlashMessages( __( 'Fehler: Ungültiges Formular. Bitte versuchen Sie es erneut.',
				'bitski-wp-theme' ), 'danger' );

			// Redirect back to the contact page.
			wp_redirect( get_permalink() );
			exit;
		}

		// Verify nonce.
		// To protect against CSRF attacks.
		if ( ! isset( $_POST['contact_form_nonce'] ) || ! wp_verify_nonce( $_POST['contact_form_nonce'],
				'contact_form_submit' ) ) {
			$this->setFlashMessages( __( 'Fehler: Ungültiges Formular. Bitte versuchen Sie es erneut.',
				'bitski-wp-theme' ), 'danger' );

			// Redirect back to the contact page.
			wp_redirect( get_permalink() );
			exit;
		}

		// Sanitize form data.
		// To prevent XSS attacks.
		$this->sanitizeFormContact();

		// Validate form data.
		// If validation fails, redirect back to the contact page.
		if ( ! $this->validateFormContact() ) {
			wp_redirect( get_permalink() );
			exit;
		}

		// The form is valid.
		// Proceed with form submission here (e.g., send email, save to database).
		//
		// Send email using the sendFormContactEmail() method.
		// Unset form contact load time from the session.
		// Set success or error flash message based on the result of the email sending.
		// Redirect back to the contact page.
		if ( $this->sendFormContactEmail() ) {
			$this->setFlashMessages( __( 'Danke, Ihre Nachricht wurde erfolgreich versendet.', 'bitski-wp-theme' ),
				'success' );
			unset(
				$_SESSION['form_contact_load_time'],
			);
		} else {
			$this->setFlashMessages( __( 'Beim Versenden der Nachricht ist leider ein Fehler aufgetreten. Bitte versuchen Sie es erneut.',
				'bitski-wp-theme' ),
				'danger' );
		}
		wp_redirect( get_permalink() );
		exit;
	}

	/**
	 * Sanitize form data for the contact page.
	 * Sanitizes input fields using WordPress sanitization functions.
	 *
	 * @since 0.8.12
	 */
	protected function sanitizeFormContact(): void {
		if ( isset( $_POST['contact_name'] ) ) {
			$this->sanitized_form_data['contact_name'] = sanitize_text_field( $_POST['contact_name'] );
		}
		if ( isset( $_POST['contact_email'] ) ) {
			$this->sanitized_form_data['contact_email'] = sanitize_email( $_POST['contact_email'] );
		}
		if ( isset( $_POST['contact_message'] ) ) {
			$this->sanitized_form_data['contact_message'] = sanitize_textarea_field( $_POST['contact_message'] );
		}
	}

	/**
	 * Validate form data for the contact page.
	 * Checks for required fields and validates email format.
	 *
	 * @return bool Returns true if the form is valid, false otherwise.
	 * @since 0.8.9
	 */
	protected function validateFormContact(): bool {
		$is_valid = true;

		$name    = isset( $this->sanitized_form_data['contact_name'] ) ? trim( $this->sanitized_form_data['contact_name'] ) : '';
		$email   = isset( $this->sanitized_form_data['contact_email'] ) ? trim( $this->sanitized_form_data['contact_email'] ) : '';
		$message = isset( $this->sanitized_form_data['contact_message'] ) ? trim( $this->sanitized_form_data['contact_message'] ) : '';

		// Check for required fields, set flash message if any field is empty or invalid
		if ( $name === '' ) {
			$this->setFlashMessages( __( 'Bitte geben Sie einen Namen ein.', 'bitski-wp-theme' ), 'danger' );
			$is_valid = false;
		}
		if ( $email === '' || ! is_email( $email ) ) {
			$this->setFlashMessages( __( 'Bitte geben Sie eine E-Mail-Adresse ein.', 'bitski-wp-theme' ), 'danger' );
			$is_valid = false;
		}
		if ( $message === '' ) {
			$this->setFlashMessages( __( 'Bitte geben Sie eine Nachricht ein.', 'bitski-wp-theme' ), 'danger' );
			$is_valid = false;
		}

		return $is_valid;
	}

	/**
	 * Send an email with the form data.
	 * Uses WordPress' wp_mail function to send the email.
	 *
	 * @since 0.8.15
	 */
	protected function sendFormContactEmail(): bool {
		$to         = apply_filters( 'bitski-wp-theme/option/forms/contact/recipient-email',
			get_option( 'admin_email' ) );
		$from_email = apply_filters( 'bitski-wp-theme/option/forms/contact/from-email', get_option( 'admin_email' ) );
		$from_name  = apply_filters( 'bitski-wp-theme/option/forms/contact/from-name', get_bloginfo( 'name' ) );
		$subject    = sprintf(
			__( 'Neue Kontaktanfrage von %s', 'bitski-wp-theme' ),
			$this->sanitized_form_data['contact_name']
		);
		$message    = sprintf(
			__( "Name: %s\nE-Mail: %s\n\nNachricht:\n%s", 'bitski-wp-theme' ),
			$this->sanitized_form_data['contact_name'],
			$this->sanitized_form_data['contact_email'],
			$this->sanitized_form_data['contact_message']
		);
		$headers    = [
			'Content-Type: text/plain; charset=UTF-8',
			sprintf( 'From: %s <%s>', $from_name, $from_email ),
			'Reply-To: ' . $this->sanitized_form_data['contact_email']
		];

		return wp_mail( $to, $subject, $message, $headers );
	}

	/**
	 * Set a flash message in the session.
	 *
	 * @param  string  $message  The message to display.
	 * @param  string  $type  The type of message (success, danger, warning).
	 */
	protected function setFlashMessages( string $message, string $type = 'success' ): void {
		if ( ! isset( $_SESSION['flash_messages'] ) ) {
			$_SESSION['flash_messages'] = [];
		}

		$_SESSION['flash_messages'][] = [
			'type' => $type,
			'text' => $message
		];
	}
}
