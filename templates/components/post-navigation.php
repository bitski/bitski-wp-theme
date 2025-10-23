<?php
/**
 * Template component for displaying post navigation links.
 * Post type: post, custom post types
 *
 * @since 0.6.11
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Set the adjacent post arguments.
$adjacent_post_args = [
        'aria_label_nav' => __( 'Beitragsnavigation', 'bitski-wp-theme' ),
];

$prev_post = get_previous_post();
$next_post = get_next_post();

// Return early if there is no adjacent post.
if ( ! $prev_post && ! $next_post ) {
    return;
} ?>

<!-- Post navigation -->
<nav class="post-navigation" aria-label="<?php echo esc_attr( $adjacent_post_args['aria_label_nav'] ); ?>">
    <ul class="pagination mb-0">
        <?php if ( $prev_post ) { ?>
            <li class="page-item">
                <a class="page-link text-light" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                    <i class="fa-solid fa-angles-left fa-xs" aria-hidden="true"></i>
                    <span><?php echo esc_html( $prev_post->post_title ); ?></span>
                </a>
            </li>
        <?php }
        if ( $next_post ) { ?>
            <li class="page-item">
                <a class="page-link text-light" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                    <span><?php echo esc_html( $next_post->post_title ); ?></span>
                    <i class="fa-solid fa-angles-right fa-xs" aria-hidden="true"></i>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
