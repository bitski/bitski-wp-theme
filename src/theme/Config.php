<?php

/** Centralized theme configuration class.
 *
 * Provides global theme options and CSS class mappings.
 * Use `Options::get()` within theme classes,
 * or `apply_filters()` within templates to retrieve values.
 *
 * @since 0.16.4
 */

namespace BitskiWPTheme\theme;

class Config
{
    /**
     * Global theme options.
     *
     * Key: option name / filter name
     * Value: global option value
     *
     * Usage:
     * - Theme core: Options::get('option-name', 'local-override-value')
     * - Templates: apply_filters('option-name', 'local-override-value')
 */
    public static array $options = [
        // Example: 'option-name/filter-name' => 'global-value'

        // Loading options
        'bitski-wp-theme/option/load-fontawesome'                      => true,
        'bitski-wp-theme/option/load-emojis'                           => false,
        'bitski-wp-theme/option/load-bootstrap-icons-sprite'           => false,

        // Header options
        'bitski-wp-theme/option/header/display-socials'                => true,
        'bitski-wp-theme/option/header/display-socials-labels'         => true,
        'bitski-wp-theme/option/header/display-search'                 => true,

        // Footer options
        'bitski-wp-theme/option/footer/display-socials'                => true,
        'bitski-wp-theme/option/footer/contacts/display'               => true,
        'bitski-wp-theme/option/footer/contacts/display-labels'        => true,
        'bitski-wp-theme/option/footer/contacts/tel'                   => '+1234567890',
        'bitski-wp-theme/option/footer/contacts/mail'                  => 'info@example.com',

        // Single post options
        'bitski-wp-theme/option/single/meta/display-author'            => true,
        'bitski-wp-theme/option/single/meta/display-date'              => true,
        'bitski-wp-theme/option/single/meta/display-date-modified'     => true,

        // Archive page options
        'bitski-wp-theme/option/archive/load-more'                     => true,
        'bitski-wp-theme/option/archive/load-more/posts-per-load-more' => 1,
        'bitski-wp-theme/option/archive/load-more/spinner-delay'       => 600,  // ms
        'bitski-wp-theme/option/archive/posts-per-page'                => 2,
        'bitski-wp-theme/option/card/meta/display-author'              => true,
        'bitski-wp-theme/option/card/meta/display-date'                => true,
        'bitski-wp-theme/option/card/meta/display-date-modified'       => true,

        // Pages options
        'bitski-wp-theme/option/pages/using-session/ids'               => [49], // [ 13, 232 ]

        // Forms options
        'bitski-wp-theme/option/forms/general/load'                    => true,
        'bitski-wp-theme/option/forms/general/antispam-delay'          => 5,
        'bitski-wp-theme/option/forms/contact/recipient-email'         => 'info@example.com',
        'bitski-wp-theme/option/forms/contact/from-email'              => 'info@example.com',
        'bitski-wp-theme/option/forms/contact/from-name'               => 'Website Kontakt',

        // Progressive web app (PWA) options
        'bitski-wp-theme/option/pwa/load'                              => false,
        'bitski-wp-theme/option/pwa/theme-color'                       => '#ffffff',

        // Schema options
        'bitski-wp-theme/option/schema/load'                           => true,
        'bitski-wp-theme/option/schema/entity/type'                    => 'Organization', // 'Organization' || 'Person'
        'bitski-wp-theme/option/schema/entity/logo-path'               => 'assets/img/logo-50x50.svg'

        // Add more option filters as needed
    ];

    /**
     * Global CSS class mappings.
     *
     * Key: filter name
     * Value: array of global CSS classes
     *
     * Usage: apply_filters('filter-name', ['local-class'])
     */
    public static array $classes = [
        // Example: 'filter-name' => [ 'class1', 'class2' ]
        'bitski-wp-theme/class/header'                   => ['sticky-top', 'bg-body-tertiary'],
        'bitski-wp-theme/class/header/navbar/breakpoint' => [],
        'bitski-wp-theme/class/header/navbar/navbar-nav' => ['ms-auto', 'mb-2', 'mb-lg-0', 'me-lg-2'],
        'bitski-wp-theme/class/container'                => [],
        // Add more class name filters as needed
    ];

    /**
     * Intentionally left empty.
     *
     * Config is a static data provider.
     */
    public function init(): void
    {
    }
}
