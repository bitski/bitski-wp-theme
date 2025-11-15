<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * The functions file for the Bitski WordPress Theme
 *
 * @since 0.1.0
 */

// Load the theme init file.
if (file_exists(__DIR__ . '/init.php')) {
    require_once __DIR__ . '/init.php';
}

add_action('init', function() {
	setcookie('test_cookie', '1', time() + 3600, '/');
});
