<?php
/**
 * Theme: bitski‑wp‑theme
 * Author: Peter Eckerle
 * Copyright (c) 2025–2026
 */

// Exits if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * The functions file for the Bitski WordPress Theme.
 *
 * @since 0.1.0
 */

// Loads the theme init file.
if (file_exists(__DIR__ . '/init.php')) {
    require_once __DIR__ . '/init.php';
}
