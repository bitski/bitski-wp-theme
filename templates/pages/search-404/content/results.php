<?php
/**
 * Template component for displaying the search results loop.
 * Used by the search.php template when posts are found.
 *
 * @since 0.5.21
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

$found_posts    = $wp_query->found_posts;
$posts_per_page = get_option('posts_per_page');
?>

<!-- Content body: search results list -->
<section class="content-body search results" aria-labelledby="search-results-heading">
    <header class="alert alert-success mb-4">
        <h2 id="search-results-heading">
            <?php
            // Build the search results found message with proper pluralization.
            printf(
                    esc_html(
                            _n(
                                    '%d Treffer gefunden',
                                    '%d Treffer gefunden',
                                    $found_posts,
                                    'bitski-wp-theme'
                            )
                    ),
                    $found_posts
            );
            ?>
        </h2>
    </header>
    <div class="content row g-4<?php
    if (paginate_links()) {
        echo ' mb-4';
    } ?>">
        <?php
        while (have_posts()) {
            the_post(); ?>
            <div class="col-12<?php
            if ($found_posts > 1 && $posts_per_page > 1) { ?>
                    col-lg-6
                <?php
            } ?>">
                <?php
                get_template_part('templates/components/post/card'); ?>
            </div>
        <?php
        } ?>
    </div>
    <?php
    get_template_part('templates/components/pagination'); ?>
</section>
