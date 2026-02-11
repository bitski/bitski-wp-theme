<?php

if ( ! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Theme bootstrap and class initialization.
 *
 * Loads the Composer autoloader if available.
 * Instantiates and initializes all core and feature classes.
 * Conditionally instantiates and initializes classes based on theme options.
 * Logs autoloader and class instantiation errors without breaking the theme.
 *
 * @since 0.2.0
 */
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
} else {
    error_log('Autoloader not found: '.__DIR__.'/vendor/autoload.php');
}

/**
 * Array of core and feature theme classes to be initialized automatically, can be extended or modified as needed.
 *
 * Core and feature classes that are initialized unconditionally.
 *
 * @var array $bootstrap_classes
 */
$bootstrap_classes = [
    \BitskiWPTheme\theme\Setup::class,
    \BitskiWPTheme\theme\Config::class,
    \BitskiWPTheme\theme\Hooks::class,
    \BitskiWPTheme\assets\Manager::class,
];

/**
 * Array of conditional classes that are only initialized if the corresponding theme option is enabled.
 *
 * Each entry maps a filter name to the class that should be instantiated.
 * Filter keys enable/disable optional theme features via theme options.
 *
 * @var array $conditional_class_map
 */
$conditional_class_map = [
    'bitski-wp-theme/option/forms/general/load' => \BitskiWPTheme\content\Manager::class,
    'bitski-wp-theme/option/archive/load-more'  => \BitskiWPTheme\content\LoadMore::class,
    'bitski-wp-theme/option/pwa/load'           => \BitskiWPTheme\theme\PWAManager::class,
    'bitski-wp-theme/option/schema/load'        => \BitskiWPTheme\theme\SchemaManager::class,
];

/**
 * Instantiate and initialize core and feature classes unconditionally.
 */
foreach ($bootstrap_classes as $class) {
    try {
        $instance = new $class();
        if (method_exists($instance, 'init')) {
            $instance->init();
        }
    } catch (\Throwable $error) {
        error_log($class.' Error: '.$error->getMessage());
    }
}

/**
 * Instantiate and initialize conditional classes based on theme option filters.
 */
foreach ($conditional_class_map as $filter => $class) {
    if (apply_filters($filter, null)) {
        try {
            $instance = new $class();
            if (method_exists($instance, 'init')) {
                $instance->init();
            }
        } catch (\Throwable $error) {
            error_log($class.' Error: '.$error->getMessage());
        }
    }
}
