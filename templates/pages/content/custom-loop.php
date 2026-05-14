<?php
/**
 * Template component for displaying a custom loop within a page's content.
 * Included by the page.php template when a page is set to show a custom loop.
 *
 * @since 0.6.1
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

$postType = 'post';
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$args = [
        'post_type'      => $postType,
        'posts_per_page' => 1,
        'paged'          => $paged,
];

$customQuery = new WP_Query($args);

if ($customQuery->have_posts()) {
    $foundPosts   = $customQuery->found_posts;
    $maxNumPages  = $customQuery->max_num_pages;
    $postsPerPage = $args['posts_per_page'];
    ?>
    <!-- Content body: post list -->
    <section class="content-body row g-4<?php
    if ($maxNumPages > 1) {
        echo ' mb-4';
    } ?>">
        <?php
        while ($customQuery->have_posts()) {
            $customQuery->the_post(); ?>
            <div class="col-12<?php
            if ($foundPosts > 1 && $postsPerPage > 1) { ?>
            col-lg-6
        <?php
            } ?>">
                <?php
                get_template_part('templates/components/post/card'); ?>
            </div>
            <?php
        }
        wp_reset_postdata(); ?>
    </section>
    <?php
    get_template_part(
            'templates/components/pagination',
            null,
            [
                    'total'   => $maxNumPages,
                    'current' => $paged,
            ]
    );
}
