<?php
/**
 * Theme options API.
 *
 * Handles theme configuration values via WordPress filters.
 *
 * @since 1.0.2
 */

namespace BitskiWPTheme\theme;

class Options
{
    /**
     * Initializes theme options API.
     */
    public function init(): void
    {
        $this->registerCssClassFilters();   // CSS classes options filters.
        $this->registerOptionFilters();     // Theme options filters.
    }

    /**
     * Registers CSS class options filters.
     */
    protected function registerCssClassFilters(): void
    {
        foreach (Config::$classes as $filter => $configClasses) {
            add_filter($filter, function ($localClasses = '', $merge = true) use ($filter) {
                // Returns classes as a space-separated string.
                return $this->getClassesByFilter($filter, $localClasses, $merge);
            }, 10, 2);
        }
    }

    /**
     * Getter for CSS classes by filter name.
     * Returns a space-separated string, merging config and local classes if $merge is true.
     * Otherwise, returns local classes only.
     *
     * @param  string  $filter
     * @param  array  $localClasses
     * @param  bool  $merge
     *
     * @return string
     */
    public function getClassesByFilter(string $filter, array $localClasses = [], bool $merge = true): string
    {
        // Get config classes if they're set and not empty.
        $configClasses = [];
        if (isset(Config::$classes[$filter]) && ! empty(Config::$classes[$filter])) {
            $configClasses = Config::$classes[$filter];
        }

        // Ensure $localClasses is an array.
        if ( ! is_array($localClasses)) {
            $localClasses = [];
        }

        // If the $merge parameter is set to true, merge config classes with local classes.
        // Returns merged classes as a space-separated string.
        if ($merge) {
            $merged_classes = array_filter(array_unique(array_merge($configClasses, $localClasses)));

            return implode(' ', $merged_classes);
        }

        // Returns local classes only as a space-separated string.
        return implode(' ', $localClasses);
    }

    /**
     * Registers theme options filters.
     */
    protected function registerOptionFilters(): void
    {
        foreach (Config::$options as $filter => $configOption) {
            add_filter($filter, function ($localOverride = null) use ($filter) {
                // Returns the config option value or the local option if set.
                return $this->getOptionByFilter($filter, $localOverride);
            });
        }
    }

    /**
     * Getter for theme options by filter name.
     *
     * Returns the local option if it is explicitly set (not null) and valid.
     * Otherwise, checks global Config options.
     *
     * @param  string  $filter
     * @param  mixed|null  $localOverride  (default: null, for a fallback to global config option)
     *
     * @return mixed The filtered option value.
     */
    public function getOptionByFilter(string $filter, mixed $localOverride = null): mixed
    {
        // Returns a local option if it is explicitly set (not null).
        // Returns a local option if it is boolean or integer,
        // or if it is set and neither an empty string nor an empty array.
        if ($localOverride !== null) {
            if (is_bool($localOverride)
                || is_int($localOverride)
                || ($localOverride !== ''
                    && ! (is_array($localOverride) && empty($localOverride)))) {
                return $localOverride;
            }
        }

        // Returns a config option if it's set and not empty.
        if (isset(Config::$options[$filter]) && Config::$options[$filter] !== '') {
            return Config::$options[$filter];
        }

        // Returns a local option as a fallback.
        return $localOverride;
    }

    /**
     * Getter for theme options by filter name.
     *
     * This method relies on `apply_filters()`, defined in getOptionByFilter().
     * Calls `apply_filters()` to fetch the filtered option, allowing for overrides via hooks.
     *
     * @param  string  $filter
     * @param  mixed|null  $localOverride
     *
     * @return mixed The filtered option value.
     * @since 1.0.3
     */
    public static function get(string $filter, mixed $localOverride = null): mixed
    {
        return apply_filters($filter, $localOverride);
    }
}
