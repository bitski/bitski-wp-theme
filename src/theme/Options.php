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
        $this->registerCssClassesFilters();   // CSS classes options filters.
        $this->registerOptionFilters();       // Theme options filters.
    }

    /**
     * Registers CSS classes options filters.
     */
    protected function registerCssClassesFilters(): void
    {
        foreach (Config::$classes as $filter => $configClasses) {
            add_filter($filter, function ($defaultClasses = '', $merge = true) use ($filter) {
                // Returns classes as a space-separated string.
                return $this->getClassesByFilter($filter, $defaultClasses, $merge);
            }, 10, 2);
        }
    }

    /**
     * Getter for CSS classes by filter name.
     * Returns a space-separated string of classes.
     * Merges config classes with default classes if $merge is true.
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
        // Get config classes if they're set and not empty.
        $configClasses = [];
        if (isset(Config::$classes[$filter]) && ! empty(Config::$classes[$filter])) {
            $configClasses = Config::$classes[$filter];
        }

        // Ensure $defaultClasses is an array.
        if ( ! is_array($defaultClasses)) {
            $defaultClasses = [];
        }

        // If the $merge parameter is set to true, merge config classes with default classes.
        // Returns merged classes as a space-separated string.
        if ($merge) {
            $merged_classes = array_filter(array_unique(array_merge($configClasses, $defaultClasses)));

            return implode(' ', $merged_classes);
        }

        // Returns default classes only as a space-separated string.
        return implode(' ', $defaultClasses);
    }

    /**
     * Registers theme options filters.
     */
    protected function registerOptionFilters(): void
    {
        foreach (Config::$options as $filter => $configOption) {
            add_filter($filter, function ($defaultOption = null) use ($filter) {
                // Returns the option value or the default option if set.
                return $this->getOptionByFilter($filter, $defaultOption);
            });
        }
    }

    /**
     * Getter for theme options by filter name.
     * Returns the default option if it is explicitly set (not null) and valid.
     * Otherwise, checks global Config options.
     *
     * @param  string  $filter
     * @param  mixed  $defaultOption  (default: null, for a fallback to global config option)
     *
     * @return mixed
     */
    public function getOptionByFilter(string $filter, mixed $defaultOption = null): mixed
    {
        // Returns a default option if it is explicitly set (not null).
        // Returns a default option if it is boolean or integer,
        // or if it is set and neither an empty string nor an empty array.
        if ($defaultOption !== null) {
            if (is_bool($defaultOption)
                || is_int($defaultOption)
                || ($defaultOption !== ''
                    && ! (is_array($defaultOption) && empty($defaultOption)))) {
                return $defaultOption;
            }
        }

        // Returns a config option if it's set and not empty.
        if (isset(Config::$options[$filter]) && Config::$options[$filter] !== '') {
            $configOption = Config::$options[$filter];

            if (is_array($configOption) || is_bool($configOption)) {
                return $configOption;
            }

            return (string)$configOption;
        }

        // Returns a default option as a fallback.
        return $defaultOption;
    }
}
