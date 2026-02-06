<?php
/**
 * Theme hooks manager.
 *
 * @since 0.1.0
 */

namespace BitskiWPTheme\theme;

use WP_Query;

/**
 * Manages theme hooks.
 *
 * @since 0.1.0
 */
class Hooks
{
    /**
     * Initialize theme hooks.
     * Registers all hooks.
     */
    public function init()
    {
        $this->registerBaseHooks();         // Base hooks, support.
        $this->registerCssClassesHooks();   // CSS classes hooks.
        $this->registerOptionHooks();       // Theme options hooks.
        $this->registerFunctionalHooks();   // Functional hooks, e.g., JS events.
    }

    /**
     * Registers base hooks.
     */
    protected function registerBaseHooks()
    {
    }

    /**
     * Registers hooks for CSS classes.
     */
    protected function registerCssClassesHooks()
    {
        foreach (Config::$classes as $filter => $setupClasses) {
            add_filter($filter, function ($defaultClasses = '', $merge = true) use ($filter) {
                // Returns classes as a space-separated string.
                return $this->getClassesByFilter($filter, $defaultClasses, $merge);
            }, 10, 2);
        }
    }

    /**
     * Getter for CSS classes by filter name.
     * Returns a space-separated string of classes.
     * Merges setup classes with default classes if $merge is true.
     * Otherwise, returns default classes only.
     *
     * @param  string  $filter
     * @param  array  $defaultClasses
     * @param  bool  $merge
     *
     * @return string
     */
    public function getClassesByFilter(string $filter, array $defaultClasses = [], bool $merge = true): string
    {
        // Get setup classes if they're set and not empty.
        $setupClasses = [];
        if (isset(Config::$classes[$filter]) && ! empty(Config::$classes[$filter])) {
            $setupClasses = Config::$classes[$filter];
        }

        // Ensure $defaultClasses is an array.
        if ( ! is_array($defaultClasses)) {
            $defaultClasses = [];
        }

        // If $merge parameter is set to true, merge setup classes with default classes.
        // Return merged classes as a space-separated string.
        if ($merge) {
            $merged_classes = array_filter(array_unique(array_merge($setupClasses, $defaultClasses)));

            return implode(' ', $merged_classes);
        }

        // Return default classes only as a space-separated string.
        return implode(' ', $defaultClasses);
    }

    /**
     * Registers hooks for theme options.
     */
    protected function registerOptionHooks()
    {
        foreach (Config::$options as $filter => $setupOption) {
            add_filter($filter, function ($defaultOption = null) use ($filter) {
                // Returns the option value or the default option if set.
                return $this->getOptionByFilter($filter, $defaultOption);
            });
        }
    }

    /**
     * Getter for theme options by filter name.
     * Returns the default option if it is explicitly set (not null) and valid.
     * Otherwise, checks global ThemeSetup options.
     *
     * @param  string  $filter
     * @param  mixed  $defaultOption  (default: null, for fallback to global setup option)
     *
     * @return mixed
     */
    public function getOptionByFilter(string $filter, mixed $defaultOption = null): mixed
    {
        // Return default option if it is explicitly set (not null).
        // Return default option if it is boolean or integer,
        // or if it is set and and neither an empty string nor an empty array.
        if ($defaultOption !== null) {
            if (is_bool($defaultOption)
                || is_int($defaultOption)
                || ($defaultOption !== ''
                    && ! (is_array($defaultOption) && empty($defaultOption)))) {
                return $defaultOption;
            }
        }

        // Return setup option if it's set and not empty.
        if (isset(Config::$options[$filter]) && Config::$options[$filter] !== '') {
            $setupOption = Config::$options[$filter];

            if (is_array($setupOption) || is_bool($setupOption)) {
                return $setupOption;
            }

            return (string)$setupOption;
        }

        // Return default option as fallback.
        return $defaultOption;
    }

    /**
     * Registers hooks for functionalities.
     */
    protected function registerFunctionalHooks()
    {
        // Archive hooks
        // Archive query override - ignore WordPress backend option.
        add_action('pre_get_posts', [$this, 'overrideArchivePostsPerPage']);

        // Header hooks
        // (To be inhabited)

        // Page hooks
        // (To be inhabited)

        // Footer hooks
        //add_action( 'wp_footer', [ $this, 'outputSvgSprite' ], 20 );
    }

    /**
     * Override archive posts per page WordPress option with theme option.
     *
     * @param  WP_Query  $query
     *
     * @since 0.1.0
     *
     */
    public function overrideArchivePostsPerPage($query)
    {
        // Return early if on admin page.
        if (is_admin()) {
            return;
        }

        // Return early if not main query or not archive or home page.
        if ( ! $query->is_main_query() || ! (is_archive() || is_home())) {
            return;
        }

        // Set theme option for posts per page.
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
