<?php

namespace BitskiWPTheme\content;

/**
 * Manages custom post types.
 *
 * @since 0.1.0
 */
class CustomPostTypes
{
    public static function init()
    {
        add_action('init', [ __CLASS__, 'registerCustomPostTypes' ], 0);;
    }
    public static function registerCustomPostTypes()
    {
        register_post_type(
            'beispiel', [
            'label'        => 'Beispiel',
            'public'       => true,
            'supports'     => [ 'title', 'editor', 'thumbnail' ],
            'show_in_rest' => true,
            ] 
        );
    }
}
