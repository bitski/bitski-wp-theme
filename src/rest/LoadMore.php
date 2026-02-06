<?php
/**
 * Manages "Load More" functionality for content loading.
 *
 * @since 0.11.0
 */

namespace BitskiWPTheme\content;

use WP_Query;
use WP_REST_Request;
use WP_REST_Response;

class LoadMore
{
    /**
     * Initialize "Load More" functionality.
     */
    public function init(): void
    {
//		echo '<script>console.log("Load More")</script>';
        add_action('rest_api_init', [$this, 'registerLoadMoreRestRoutes']);
    }

    /**
     * Register REST API routes.
     */
    public function registerLoadMoreRestRoutes(): void
    {
        register_rest_route('bitski-wp-theme/v1', '/posts/load-more', [
                'methods'             => 'GET',
                'callback'            => [$this, 'getPosts'],
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

    /**
     * Handle GET requests to retrieve posts.
     *
     * @param  WP_REST_Request  $request
     *
     * @return WP_REST_Response
     */
    public function getPosts(WP_REST_Request $request): WP_REST_Response
    {
        $posts_per_load_more = apply_filters('bitski-wp-theme/option/archive/load-more/posts-per-load-more', null);
        $posts_per_page      = apply_filters('bitski-wp-theme/option/archive/posts-per-page', null);

        // Get request parameters.
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

                // Put a wrapper around the card in order to apply the Bootstrap grid.
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

        return new WP_REST_Response([
                'posts_html' => $posts_html,
                'offset'     => $offset + count($posts_html),
                'has_more'   => $offset + count($posts_html) < $found_posts,
        ]);
    }
}
