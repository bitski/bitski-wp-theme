<?php

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
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
 * Note: The order of the classes in this array determines the initialization order.
 * Classes earlier in the array will be initialized first.
 * Initialization order:
 * - Config         → base configuration
 * - Options        → depends on Config
 * - Setup          → registers core WordPress features
 * - Hooks          → attaches runtime hooks
 * - AssetsLoader   → loads theme assets
 *
 * @var array $bootstrap_classes
 */
$bootstrap_classes = [
    \BitskiWPTheme\theme\Config::class,
    \BitskiWPTheme\theme\Options::class,
    \BitskiWPTheme\theme\Setup::class,
    \BitskiWPTheme\theme\Hooks::class,
    \BitskiWPTheme\assets\AssetsLoader::class,
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
    'bitski-wp-theme/option/forms/general/load' => \BitskiWPTheme\forms\FormHandler::class,
    'bitski-wp-theme/option/archive/load-more'  => \BitskiWPTheme\rest\LoadMoreHandler::class,
    'bitski-wp-theme/option/pwa/load'           => \BitskiWPTheme\theme\PWA::class,
    'bitski-wp-theme/option/schema/load'        => \BitskiWPTheme\theme\Schema::class,
];

/**
 * Instantiates and initializes core and feature classes unconditionally.
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
 * Instantiates and initializes conditional classes based on theme option filters.
 */
foreach ($conditional_class_map as $option_key => $class) {
    if (\BitskiWPTheme\theme\Options::get($option_key)) {
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
