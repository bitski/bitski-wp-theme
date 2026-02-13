<?php
/**
 * Template component for displaying post meta data.
 * Post type: post, custom post types
 *
 * @since 0.6.16
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

// Gets the context from the calling template.
$context = $args['context'] ?? '';

// Returns early if no context is provided.
if (empty($context)) {
    return;
}

// Gets the meta data options, based on the context.
$display_author        = apply_filters('bitski-wp-theme/option/'.$context.'/meta/display-author', true);
$display_date          = apply_filters('bitski-wp-theme/option/'.$context.'/meta/display-date', true);
$display_date_modified = apply_filters('bitski-wp-theme/option/'.$context.'/meta/display-date-modified', true);

// Returns early if no meta data should be displayed.
if ( ! $display_author && ! $display_date) {
    return;
}

// Gets the author name.
$author_ID   = get_post_field('post_author', get_the_ID());
$author_name = get_the_author_meta('display_name', $author_ID);

// Gets the date values.
$published_date_unix = get_the_date('U');
$modified_date_unix  = get_the_modified_date('U');
$published_date_iso  = get_the_date('c');
$modified_date_iso   = get_the_modified_date('c');
$published_date      = get_the_date();
$modified_date       = get_the_modified_date();
?>

<!-- Post meta data -->
<p class="post-meta d-flex flex-wrap mb-2 small">
    <?php
    if ($display_author) { ?>
        <span class="post-meta-author vcard me-2">
            <span class="fn">
                <?php
                echo esc_html($author_name); ?>
            </span>
        </span>
    <?php
    }
    if ($display_author && $display_date) { ?>
        <span class="post-meta-separator pipe me-2">|</span>
    <?php
    }
    if ($display_date) { ?>
        <time class="post-meta-date published me-1" datetime="<?php
        echo esc_attr($published_date_iso); ?>">
            <?php
            echo esc_html($published_date); ?>
        </time>
        <?php
        if ($display_date_modified && $published_date_unix !== $modified_date_unix) { ?>
            <span class="post-meta-separator en-dash me-1">&ndash;</span>
            <time class="post-meta-date modified" datetime="<?php
            echo esc_attr($modified_date_iso); ?>">
                <?php
                echo esc_html($modified_date); ?>
            </time>
        <?php
        }
    } ?>
</p>
