<?php
/**
 * Template component for displaying a pagination.
 *
 * @since 0.6.0
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

global $wp_query;

// Sets the pagination arguments.
$paginationArgs = [
        'aria_label_nav' => __('Seitennavigation', 'bitski-wp-theme'),
        'prev_text'      => __('Vorherige', 'bitski-wp-theme'),
        'next_text'      => __('Nächste', 'bitski-wp-theme'),
        'type'           => 'array',
];

/*
 * Custom loop: the total and current page are passed as arguments from the parent template.
 * Standard loop: the total and current page are retrieved from the global $wp_query object.
 */
if (isset($args['total']) && $args['current']) {
    $paginationArgs['total']   = (int)$args['total'];
    $paginationArgs['current'] = (int)$args['current'];
} else {
    $paginationArgs['total']   = $wp_query->max_num_pages;
    $paginationArgs['current'] = max(1, get_query_var('paged'));
}

// Gets the pagination links.
$links = paginate_links($paginationArgs);

// Returns early if there are no pagination links to display.
if ( ! $links) {
    return;
} ?>

<!-- Pagination -->
<nav class="pagination" aria-label="<?php
echo esc_attr__($paginationArgs['aria_label_nav'], 'bitski-wp-theme'); ?>">
    <ul class="pagination mb-0">
        <?php
        foreach ($links as $link) {
            // Identifies the current page link to highlight it with Bootstrap classes for accessibility.
            if (str_contains($link, 'current')) { ?>
                <li class="page-item active" aria-current="page">
                    <?php
                    // Replaces the 'page-numbers' class with Bootstrap classes for styling.
                    echo str_replace('page-numbers', 'page-link text-light', $link); ?>
                </li>
                <?php
            } else { ?>
                <li class="page-item">
                    <?php
                    echo str_replace('page-numbers', 'page-link text-light', $link); ?>
                </li>
                <?php
            }
        } ?>
    </ul>
</nav>
