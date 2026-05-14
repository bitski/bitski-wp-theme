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
$displayAuthor       = apply_filters('bitski-wp-theme/option/' . $context . '/meta/display-author', true);
$displayDate         = apply_filters('bitski-wp-theme/option/' . $context . '/meta/display-date', true);
$displayDateModified = apply_filters('bitski-wp-theme/option/' . $context . '/meta/display-date-modified', true);

// Returns early if no meta data should be displayed.
if ( ! $displayAuthor && ! $displayDate) {
    return;
}

// Gets the author name.
$authorId   = get_post_field('post_author', get_the_ID());
$authorName = get_the_author_meta('display_name', $authorId);

// Gets the date values.
$publishedDateUnix = get_the_date('U');
$modifiedDateUnix  = get_the_modified_date('U');
$publishedDateIso  = get_the_date('c');
$modifiedDateIso   = get_the_modified_date('c');
$publishedDate     = get_the_date();
$modifiedDate      = get_the_modified_date();
?>

<!-- Post meta data -->
<p class="post-meta d-flex flex-wrap mb-2 small">
    <?php
    if ($displayAuthor) { ?>
        <span class="post-meta-author vcard me-2">
            <span class="fn">
                <?php
                echo esc_html($authorName); ?>
            </span>
        </span>
        <?php
    }
    if ($displayAuthor && $displayDate) { ?>
        <span class="post-meta-separator pipe me-2">|</span>
        <?php
    }
    if ($displayDate) { ?>
        <time class="post-meta-date published me-1" datetime="<?php
        echo esc_attr($publishedDateIso); ?>">
            <?php
            echo esc_html($publishedDate); ?>
        </time>
        <?php
        if ($displayDateModified && $publishedDateUnix !== $modifiedDateUnix) { ?>
            <span class="post-meta-separator en-dash me-1">&ndash;</span>
            <time class="post-meta-date modified" datetime="<?php
            echo esc_attr($modifiedDateIso); ?>">
                <?php
                echo esc_html($modifiedDate); ?>
            </time>
            <?php
        }
    } ?>
</p>
