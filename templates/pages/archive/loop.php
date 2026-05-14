<?php
/**
 * Template component for displaying the archive pages loop.
 * Used by archive.php and index.php template when posts are found.
 *
 * @since 0.13.0
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

if (have_posts()) {
    $foundPosts   = $wp_query->found_posts;
    $postsPerPage = apply_filters('bitski-wp-theme/option/archive/posts-per-page', null);
    $hasLoadMore  = (bool)apply_filters('bitski-wp-theme/option/archive/load-more', null);
    if ($hasLoadMore) {
        $spinnerDelay = (int)apply_filters('bitski-wp-theme/option/archive/load-more/spinner-delay', null);
    }
    ?>
    <!-- Content body: post list -->
    <section class="content-body row g-4<?php
    if ($hasLoadMore || paginate_links()) {
        echo ' mb-4';
    } ?>"
             data-posts-per-page="<?php
             echo esc_attr($postsPerPage); ?>"
             data-found-posts="<?php
             echo esc_attr($foundPosts); ?>"
            <?php
            if ($hasLoadMore) { ?>
                data-spinner-delay="<?php
                echo esc_attr($spinnerDelay); ?>"
                <?php
            } ?>>
        <?php
        while (have_posts()) {
            the_post(); ?>
            <div class="col-12<?php
            if ($foundPosts > 1 && $postsPerPage > 1) { ?>
                    col-lg-6
                <?php
            } ?>">
                <?php
                get_template_part('templates/components/post/card'); ?>
            </div>
            <?php
        } ?>
    </section>
    <?php
    if ( ! $hasLoadMore) {
        get_template_part('templates/components/pagination');
    } elseif ($foundPosts > $postsPerPage) {
        get_template_part('templates/components/load-more/button');
    }
} else { ?>
    <!-- Content body: no posts -->
    <section class="content-body no-posts">
        <header class="no-posts-header alert alert-primary mb-4">
            <h2 class="no-posts-title"><?php
                echo esc_html__(
                        'Keine Beiträge gefunden!',
                        'bitski-wp-theme'
                ); ?></h2>
        </header>
        <div class="no-posts-content">
            <p class="alert alert-info mb-4"><?php
                echo esc_html__(
                        'Zurzeit sind keine Beiträge verfügbar. Bitte besuche uns später wieder oder nutze die Suche:',
                        'bitski-wp-theme'
                ); ?></p>
            <?php
            get_template_part('templates/components/search/form', null, ['class' => 'mb-4']); ?>
        </div>
    </section>
    <?php
} ?>
