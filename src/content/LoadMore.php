<?php
/**
 * Manages "Load More" functionality for content loading.
 *
 * @since 0.11.0
 */

namespace BitskiWpTheme\content;

use WP_REST_Request;
use WP_REST_Response;

class LoadMore {
	/**
	 * Initialize "Load More" functionality.
	 */
	public function init(): void {
		echo'<script>console.log("Load More")</script>';
		add_action('rest_api_init', [ $this, 'registerRestRoutes']);
	}

	/**
	 * Register REST API routes.
	 */
	public function registerRestRoutes(): void {
		register_rest_route( 'bitski-wp-theme/v1', '/posts', [
			'methods' => 'GET',
			'callback' => [$this, 'getPosts']
		] );
	}

	/**
	 * Handle GET requests to retrieve posts.
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	public function getPosts(WP_REST_Request $request): WP_REST_Response {
		return new WP_REST_Response([

		]);
	}
}
