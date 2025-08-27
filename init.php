<?php
/**
 * Theme bootstrap and class initialization.
 *
 * Loads Composer autoloader and initializes core theme classes.
 *
 * Handles error logging if autoloader is missing.
 *
 * @since 0.2.0
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    error_log('Autoloader not found: ' . __DIR__ . '/vendor/autoload.php');
}

// Array of core theme classes to  to be initialized automatically, can be extended or modified as needed.
$classes = [
    \BitskiWPTheme\theme\ThemeSetup::class,
    \BitskiWPTheme\assets\AssetsManager::class,
    \BitskiWPTheme\theme\ThemeHooks::class,
];

// Instantiate each class and call its init() method if it exists.
foreach ($classes as $class) {
    try {
        $instance = new $class();
        if (method_exists($instance, 'init')) {
            $instance->init();
        }
    } catch (\Throwable $error) {
        error_log($class . ' Error: ' . $error->getMessage());
    }
}
