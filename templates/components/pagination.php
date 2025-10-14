<?php
/**
 * The template component for displaying a pagination.
 *
 * @since 0.6.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Define the arguments for the paginate_links function.
 *
 * The aria-label attribute for the pagination navigation.
 * The texts for the previous/next page links.
 * Output the pagination links as array.
 */
$args  = [
        'aria_label_nav' => __( 'Seitennavigation', 'bitski-wp-theme' ),
        'prev_text'      => __( 'Vorherige', 'bitski-wp-theme' ),
        'next_text'      => __( 'Nächste', 'bitski-wp-theme' ),
        'type'           => 'array',
];

// Get the pagination links.
$links = paginate_links( $args );

// Check if there are pagination links to display.
if ( $links ) { ?>
    <footer class="pagination">
        <nav aria-label="<?php echo esc_attr( $args['aria_label_nav'] ); ?>">
            <ul class="pagination">
                <?php foreach ( $links as $link ) {
                    // Identify the current page link to highlight it with Bootstrap classes for accessibility.
                    if ( str_contains( $link, 'current' ) ) { ?>
                        <li class="page-item active" aria-current="page">
                            <?php
                            // Replace the 'page-numbers' class with Bootstrap classes for styling.
                            echo str_replace( 'page-numbers', 'page-link text-light', $link ); ?>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <?php echo str_replace( 'page-numbers', 'page-link text-light', $link ); ?>
                        </li>
                    <?php }
                } ?>
            </ul>
        </nav>
    </footer>
<?php } ?>
