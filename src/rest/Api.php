<?php
/**
 * Theme REST API gateway.
 *
 * Registers and handles REST API routes.
 *
 * @since 1.0.3
 */

namespace BitskiWPTheme\rest;

use BitskiWPTheme\theme\Options;
use WP_Query;
use WP_REST_Request;
use WP_REST_Response;

class Api
{
    /**
     * Initializes theme REST API gateway.
     */
    public function init(): void
    {
        add_action('rest_api_init', [$this, 'registerRestRoutes']);
    }

    /**
     * Registers REST API routes.
     */
    public function registerRestRoutes(): void
    {
        register_rest_route('bitski-wp-theme/v1', '/posts/load-more', [
            'methods'             => 'GET',
            'callback'            => [$this, 'getPostsByType'],
            'permission_callback' => '__return_true',
            'args'                => [
                'offset'    => [
                    'type'    => 'integer',
                    'default' => 0
                ],
                'post_type' => [
                    'type'    => 'string',
                    'default' => 'post'
                ]
            ]
        ]);
        // Add additional endpoints here as needed.
    }

    /**
     * Handles GET requests to retrieve posts of the requested post type.
     *
     * Note: The response contains rendered HTML, not raw post data.
     *
     * @param  WP_REST_Request  $request
     *
     * @return WP_REST_Response
     */
    public function getPostsByType(WP_REST_Request $request): WP_REST_Response
    {
        // Loads theme config options for pagination.
        $posts_per_load_more = Options::get('bitski-wp-theme/option/archive/load-more/posts-per-load-more');
        $posts_per_page      = Options::get('bitski-wp-theme/option/archive/posts-per-page');

        // Extracts request parameters with defaults..
        $post_type   = (string)$request->get_param('post_type') ?: 'post';
        $offset      = (int)($request->get_param('offset') ?: 0);
        $found_posts = (int)($request->get_param('found_posts') ?: 0);

        $args = [
            'post_type'           => $post_type,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'posts_per_page'      => $posts_per_load_more,
            'offset'              => $offset,
        ];

        $custom_query = new WP_Query($args);
        $posts_html   = [];

        if ($custom_query->have_posts()) {
            while ($custom_query->have_posts()) {
                $custom_query->the_post();

                // Puts a wrapper around the card in order to apply the Bootstrap grid.
                ob_start(); ?>
                <div class="col-12<?php
                if ($found_posts > 1 && $posts_per_page > 1) { ?> col-lg-6<?php
                } ?>">
                    <?php
                    get_template_part('templates/components/post/card'); ?>
                </div>
                <?php
                $posts_html[] = ob_get_clean();
            }
            wp_reset_postdata();
        }

        // Returns HTML, updated offset, and has_more flag in REST response.
        return new WP_REST_Response([
            'posts_html' => $posts_html,
            'offset'     => $offset + count($posts_html),
            'has_more'   => $offset + count($posts_html) < $found_posts,
        ]);
    }
}
