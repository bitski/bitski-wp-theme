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

$post_type = 'post';
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$args = [
        'post_type'      => $post_type,
        'posts_per_page' => 1,
        'paged'          => $paged,
];

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    $found_posts    = $custom_query->found_posts;
    $max_num_pages  = $custom_query->max_num_pages;
    $posts_per_page = $args['posts_per_page'];
    ?>
    <!-- Content body: post list -->
    <section class="content-body row g-4<?php
    if ($max_num_pages > 1) {
        echo ' mb-4';
    } ?>">
        <?php
        while ($custom_query->have_posts()) {
            $custom_query->the_post(); ?>
            <div class="col-12<?php
            if ($found_posts > 1 && $posts_per_page > 1) { ?>
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
                    'total'   => $max_num_pages,
                    'current' => $paged,
            ]
    );
}
