<?php
/**
 * Custom Post Types.
 *
 * @since 0.1.0
 */
namespace BitskiWPTheme\content;

/**
 * Manages custom post types.
 *
 * @since 0.1.0
 */
class CustomPostTypes
{
    public function init()
    {
        add_action('init', [ $this, 'registerCustomPostTypes' ], 0);;
    }
    public function registerCustomPostTypes()
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
