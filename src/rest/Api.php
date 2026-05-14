<?php
/**
 * Theme REST API gateway.
 *
 * Registers REST API routes for the theme.
 *
 * Routes are registered conditionally based on the theme config options.
 * Each route is registered with a callback function that handles the request.
 * The callback function is responsible for fetching and returning the data needed for the route.
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
        // Registers the 'load-more' REST route if the feature is enabled in config options.
        if (Options::get('bitski-wp-theme/option/archive/load-more')) {
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
        }
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
        $postsPerLoadMore = Options::get('bitski-wp-theme/option/archive/load-more/posts-per-load-more');
        $postsPerPage     = Options::get('bitski-wp-theme/option/archive/posts-per-page');

        // Extracts request parameters with defaults..
        $postType   = (string)$request->get_param('post_type') ?: 'post';
        $offset     = (int)($request->get_param('offset') ?: 0);
        $foundPosts = (int)($request->get_param('found_posts') ?: 0);

        $args = [
                'post_type'           => $postType,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => true,
                'posts_per_page'      => $postsPerLoadMore,
                'offset'              => $offset,
        ];

        $customQuery = new WP_Query($args);
        $postsHtml   = [];

        if ($customQuery->have_posts()) {
            while ($customQuery->have_posts()) {
                $customQuery->the_post();

                // Puts a wrapper around the card in order to apply the Bootstrap grid.
                ob_start(); ?>
                <div class="col-12<?php
                if ($foundPosts > 1 && $postsPerPage > 1) { ?> col-lg-6<?php
                } ?>">
                    <?php
                    get_template_part('templates/components/post/card'); ?>
                </div>
                <?php
                $postsHtml[] = ob_get_clean();
            }
            wp_reset_postdata();
        }

        // Returns HTML, updated offset, and has_more flag in REST response.
        return new WP_REST_Response([
                'posts_html' => $postsHtml,
                'offset'     => $offset + count($postsHtml),
                'has_more'   => $offset + count($postsHtml) < $foundPosts,
        ]);
    }
}
