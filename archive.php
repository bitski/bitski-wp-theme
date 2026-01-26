<?php
/**
 * Template for displaying archive pages.
 * Post type: post, custom post types
 *
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="content" class="content <?php
echo esc_attr(
        apply_filters(
                'bitski-wp-theme/class/container',
                ['container-xl'],
                true
        )
); ?> pt-4 pb-5">
    <!-- Content header -->
    <header class="content-header mb-4">
        <h1 class="archive-title"><?php
            the_archive_title(); ?></h1>
        <p class="archive-description"><?php
            the_archive_description(); ?></p>
    </header>

    <?php
    get_template_part('templates/pages/archive/loop'); ?>
</main>

<?php
get_footer(); ?>
