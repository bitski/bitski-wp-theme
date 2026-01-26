<?php
/**
 * Template component for displaying the archive pages loop.
 * Used by archive.php and index.php template when posts are found.
 *
 * @since 0.13.0
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

if (have_posts()) {
    $found_posts    = $wp_query->found_posts;
    $posts_per_page = apply_filters('bitski-wp-theme/option/archive/posts-per-page', null);
    $has_load_more  = (bool)apply_filters('bitski-wp-theme/option/archive/load-more', null);
    if ($has_load_more) {
        $spinner_delay = (int)apply_filters('bitski-wp-theme/option/archive/load-more/spinner-delay', null);
    }
    ?>
    <!-- Content body: post list -->
    <section class="content-body row g-4<?php
    if ($has_load_more || paginate_links()) {
        echo ' mb-4';
    } ?>"
             data-posts-per-page="<?php
             echo esc_attr($posts_per_page); ?>"
             data-found-posts="<?php
             echo esc_attr($found_posts); ?>"
            <?php
            if ($has_load_more) { ?>
                data-spinner-delay="<?php
                echo esc_attr($spinner_delay); ?>"
            <?php
            } ?>>
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
    </section>
    <?php
    if ( ! $has_load_more) {
        get_template_part('templates/components/pagination');
    } elseif ($found_posts > $posts_per_page) {
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
