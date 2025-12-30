<?php
/**
 * Manages "Load More" functionality for content loading.
 *
 * @since 0.11.0
 */

namespace BitskiWPTheme\content;

use WP_REST_Request;
use WP_REST_Response;
use WP_Query;

class LoadMore {
	/**
	 * Initialize "Load More" functionality.
	 */
	public function init(): void {
		echo '<script>console.log("Load More")</script>';
		add_action( 'rest_api_init', [ $this, 'registerLoadMoreRestRoutes' ] );
	}

	/**
	 * Register REST API routes.
	 */
	public function registerLoadMoreRestRoutes(): void {
		register_rest_route( 'bitski-wp-theme/v1', '/loadmore-posts', [
			'methods'             => 'GET',
			'callback'            => [ $this, 'getPosts' ],
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
		] );
	}

	/**
	 * Handle GET requests to retrieve posts.
	 *
	 * @param  WP_REST_Request  $request
	 *
	 * @return WP_REST_Response
	 */
	public function getPosts( WP_REST_Request $request ): WP_REST_Response {
		$post_type          = $request->get_param( 'post_type' ) ?: 'post';
		$posts_per_load_more = apply_filters( 'bitski-wp-theme/option/archive/posts-per-load-more', null );
		$offset             = (int) ( $request->get_param( 'offset' ) ?: 0 );

		$args = array(
			'post_type'           => $post_type,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $posts_per_load_more,
			'offset'              => $offset,
		);

		$custom_query = new WP_Query( $args );
		$posts        = [];
		$found_posts  = $custom_query->found_posts;

		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				$posts[] = [
					'id'      => get_the_ID(),
					'title'   => get_the_title(),
					'link'    => get_permalink(),
					'excerpt' => get_the_excerpt(),
				];
			}
			wp_reset_postdata();
		}

		return new WP_REST_Response( [
			'posts'    => $posts,
			'total'    => $found_posts,
			'offset'   => $offset + count( $posts ),
			'has_more' => $offset + count( $posts ) < $found_posts,
		] );
	}
}
