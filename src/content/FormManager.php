<?php
/**
 * Manages theme forms.
 *
 * @since 0.8.0
 */

namespace BitskiWPTheme\content;

class FormManager {
	/*
	 * Initialize form manager
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

		// Check for form submission
		if ( ! empty( $_POST ) ) {
			// Verify nonce
			if ( ! isset( $_POST['contact_form_nonce'] ) || ! wp_verify_nonce( $_POST['contact_form_nonce'],
					'contact_form_submit' ) ) {
				$this->setFlashMessage( 'Fehler: Ungültiges Formular. Bitte versuchen Sie es erneut.', 'danger' );

				// Redirect back to the contact page
				wp_redirect( get_permalink() );
				exit;
			}

			$this->setFlashMessage( 'Danke, Ihre Nachricht wurde erfolgreich versendet.', 'success' );

			// Redirect back to the contact page
			wp_redirect( get_permalink() );
			exit;
		}
	}

	/*
	 * Set a flash message in the session.
	 *
	 * @param string $message The message to display.
	 * @param string $type The type of message (success, danger, warning).
	 */
	protected function setFlashMessage( $message, $type = 'success' ): void {
		global $_SESSION;
		$_SESSION['flash_message'] = [
			'type' => $type,
			'text' => $message
		];
	}
}
