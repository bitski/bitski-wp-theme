<?php
/**
 * Template component for displaying post navigation links.
 * Post type: post, custom post types
 *
 * @since 0.6.11
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

$ariaLabelNav = __('Beitragsnavigation', 'bitski-wp-theme');

// Gets the adjacent posts.
$prevPost = get_previous_post();
$nextPost = get_next_post();

// Returns early if there is no adjacent post.
if ( ! $prevPost && ! $nextPost) {
    return;
} ?>

<!-- Post navigation -->
<nav class="post-navigation" aria-label="<?php
echo esc_attr__($ariaLabelNav, 'bitski-wp-theme'); ?>">
    <ul class="pagination mb-0">
        <?php
        if ($prevPost) { ?>
            <li class="page-item">
                <a class="page-link text-light" href="<?php
                echo esc_url(get_permalink($prevPost->ID)); ?>"
                   rel="prev">
                    <i class="fa-solid fa-angles-left fa-xs" aria-hidden="true"></i>
                    <span><?php
                        echo esc_html($prevPost->post_title); ?></span>
                </a>
            </li>
            <?php
        }
        if ($nextPost) { ?>
            <li class="page-item">
                <a class="page-link text-light" href="<?php
                echo esc_url(get_permalink($nextPost->ID)); ?>"
                   rel="next">
                    <span><?php
                        echo esc_html($nextPost->post_title); ?></span>
                    <i class="fa-solid fa-angles-right fa-xs" aria-hidden="true"></i>
                </a>
            </li>
            <?php
        } ?>
    </ul>
</nav>
