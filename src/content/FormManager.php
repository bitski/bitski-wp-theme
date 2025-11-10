<?php
/**
 * Manages theme forms.
 *
 * @since 0.8.0
 */
namespace BitskiWPTheme\content;

/**
 * Manages theme forms.
 *
 * @since 0.8.0
 */

class FormManager {
	public function init() {
		$this->processFormContact();
	}

	public function processFormContact() {
		return 'Kontaktformular verarbeitet';
	}
}
