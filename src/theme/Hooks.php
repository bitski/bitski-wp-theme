<?php
/**
 * Theme hooks manager.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\theme;

use WP_Query;

class Hooks
{
    /**
     * Initializes theme hooks.
     * Registers all hooks.
     */
    public function init(): void
    {
        $this->registerBaseHooks();         // Base hooks, e.g.: support, image sizes.
        $this->registerFunctionalHooks();   // Functional hooks, e.g., JS events, archive query, footer actions.
    }

    /**
     * Registers base hooks.
     */
    protected function registerBaseHooks(): void
    {}

    /**
     * Registers functional hooks.
     */
    protected function registerFunctionalHooks(): void
    {
        // Archive hooks.
        // Archive query override - ignore WordPress backend option.
        add_action('pre_get_posts', [$this, 'overrideArchivePostsPerPage']);

        // Header hooks.
        // (To be inhabited)

        // Page hooks.
        // (To be inhabited)

        // Footer hooks.
        //add_action('wp_footer', [ $this, 'outputSvgSprite' ], 20 );
    }

    /**
     * Overrides an archive posts per page WordPress option with a theme option.
     *
     * @param  WP_Query  $query
     *
     * @since 0.1.0
     */
    public function overrideArchivePostsPerPage(WP_Query $query): void
    {
        // Returns early if on the admin page.
        if (is_admin()) {
            return;
        }

        // Returns early if not the main query or not archive or home page.
        if ( ! $query->is_main_query() || ! (is_archive() || is_home())) {
            return;
        }

        // Sets a theme option for posts per page.
        $posts_per_page = apply_filters('bitski-wp-theme/option/archive/posts-per-page', null);
        $query->set('posts_per_page', $posts_per_page);
    }

    /**
     * Outputs Bootstrap icons SVG sprite in the footer.
     * Applies filter to enable/disable the sprite output.
     * Ensures the sprite file exists before outputting its content.
     */
    public function outputSvgSprite(): void
    {
        if (apply_filters('bitski-wp-theme/option/load-bootstrap-icons-sprite', true)) {
            $spritePath = get_template_directory().'/assets/svg/bootstrap-icons.svg';
            if (file_exists($spritePath)) {
                echo file_get_contents($spritePath);
            }
        }
    }
}
