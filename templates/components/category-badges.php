<?php
/**
 * Template component for displaying category badges of the current post.
 * Post type: post, custom post types
 *
 * @since 0.6.14
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$aria_label_nav = __( 'Kategorienavigation des Beitrages', 'bitski-wp-theme' );

// Get the related categories.
$categories = get_the_category();

// Return early if there are no related categories.
if ( empty( $categories ) ) {
    return;
} ?>

<!-- Category badges -->
<nav class="category-badges" aria-label="<?php echo esc_attr( $aria_label_nav ); ?>">
    <ul class="list-unstyled d-flex flex-wrap gap-2"><?php
        $category_names = [];
        foreach ( $categories as $category ) {
            $category_names[] = $category->name; ?>
            <li class="">
                <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"
                   class="category-badge badge bg-primary-subtle text-decoration-none text-primary-emphasis">
                    <span><?php echo esc_html( $category->name ); ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
