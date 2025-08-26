<?php
/**
 * Theme setup class
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\theme;

class ThemeSetup
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'themeSupport']);
        add_action('after_setup_theme', [__CLASS__, 'loadTextdomain']);
    }

    public static function themeSupport()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support(
            'html5',
            [
                'caption',
                'comment-form',
                'comment-list',
                'gallery',
                'search-form'
            ]
        );
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');
    }

    public static function loadTextdomain()
    {
        load_theme_textdomain('bitski-wp-theme', get_template_directory() . '/languages');
    }
}
