<?php
/**
 * The functions file for the Bitski WordPress Theme
 *
 * @since 0.1.0
 */
require_once __DIR__ . '/inc/theme/ThemeSetup.php';
require_once __DIR__ . '/inc/theme/ThemeHooks.php';
require_once __DIR__ . '/inc/theme/ThemeHelpers.php';
require_once __DIR__ . '/inc/content/CustomPostTypes.php';
require_once __DIR__ . '/inc/assets/Assets.php';

\BitskiWPTheme\theme\ThemeSetup::init();
\BitskiWPTheme\assets\AssetsManager::init();
\BitskiWPTheme\theme\ThemeHooks::init();
//\BitskiWPTheme\theme\ThemeHelpers::init();
//\BitskiWPTheme\content\CustomPostTypes::init();

