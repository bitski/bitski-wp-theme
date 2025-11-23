<?php
/**
 * Manages theme forms.
 *
 * Handles form submission and validation for the contact page.
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

	/*
	 * Initialize form manager.
	 * Add form processing actions.
	 */
	public function init(): void {
		add_action( 'template_redirect', [ $this, 'processFormContact' ] );
	}

	/*
	 * Process form submission for the contact page.
	 * Checks for form submission and handles form validation and submission.
	 */
	public function processFormContact(): void {
		// Return early if not on the contact page
		if ( ! is_page( 'kontakt' ) ) {
			return;
		}

		// Check for form submission.
		if ( ! empty( $_POST ) ) {
			// Verify nonce.
			if ( ! isset( $_POST['contact_form_nonce'] ) || ! wp_verify_nonce( $_POST['contact_form_nonce'],
					'contact_form_submit' ) ) {
				$this->setFlashMessages( 'Fehler: Ungültiges Formular. Bitte versuchen Sie es erneut.', 'danger' );

				// Redirect back to the contact page.
				wp_redirect( get_permalink() );
				exit;
			}

			// Sanitize form data.
			$this->sanitizeFormContact();

			// Validate form data.
			// If validation fails, redirect back to the contact page.
			if(! $this->validateFormContact()) {
				wp_redirect( get_permalink() );
				exit;
			}

			// The form is valid.
			// Proceed with form submission here (e.g., send email, save to database).
			// Redirect back to the contact page.
			$this->setFlashMessages( 'Danke, Ihre Nachricht wurde erfolgreich versendet.', 'success' );
			wp_redirect( get_permalink() );
			exit;
		}
	}

	/*
	 * Sanitize form data for the contact page.
	 * Sanitizes input fields using WordPress sanitization functions.
	 *
	 * @since 0.8.12
	 */
	protected function sanitizeFormContact(): void {
		if (isset($_POST['contact_name'])) {
			$this->sanitized_form_data['contact_name'] = sanitize_text_field($_POST['contact_name']);
		}
		if (isset($_POST['contact_email'])) {
			$this->sanitized_form_data['contact_email'] = sanitize_email($_POST['contact_email']);
		}
		if (isset($_POST['contact_message'])) {
			$this->sanitized_form_data['contact_message'] = sanitize_textarea_field($_POST['contact_message']);
		}
	}

	/*
	 * Validate form data for the contact page.
	 * Checks for required fields and validates email format.
	 *
	 * @return bool Returns true if the form is valid, false otherwise.
	 * @since 0.8.9
	 */
	protected function validateFormContact(): bool {
		$is_valid = true;

		$name = isset($this->sanitized_form_data['contact_name']) ? trim($this->sanitized_form_data['contact_name']) : '';
		$email = isset($this->sanitized_form_data['contact_email']) ? trim($this->sanitized_form_data['contact_email']) : '';
		$message = isset($this->sanitized_form_data['contact_message']) ? trim($this->sanitized_form_data['contact_message']) : '';

		// Check for required fields, set flash message if any field is empty or invalid
		if ($name === '') {
			$this->setFlashMessages('Bitte geben Sie einen Namen ein.', 'danger');
			$is_valid = false;
		}
		if ($email === '' || !is_email($email)) {
			$this->setFlashMessages('Bitte geben Sie eine E-Mail-Adresse ein.', 'danger');
			$is_valid = false;
		}
		if ( $message === '' ) {
			$this->setFlashMessages('Bitte geben Sie eine Nachricht ein.', 'danger');
			$is_valid = false;
		}

		return $is_valid;
	}

	/*
	 * Set a flash message in the session.
	 *
	 * @param string $message The message to display.
	 * @param string $type The type of message (success, danger, warning).
	 */
	protected function setFlashMessages( $message, $type = 'success' ): void {
		global $_SESSION;
		if (!isset($_SESSION['flash_messages'])) {
			$_SESSION['flash_messages'] = [];
		}

		$_SESSION['flash_messages'][] = [
			'type' => $type,
			'text' => $message
		];
	}
}
