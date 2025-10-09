<?php
/**
 * The template component for displaying the no search results message.
 * Used by the search.php template when no posts are found.
 *
 * @since 0.5.21
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="search no-results">
    <header class="alert alert-primary mb-4">
        <h2><?php echo esc_html( 'Keine Ergebnisse gefunden!', 'bitski-wp-theme' ); ?></h2>
    </header>
    <div class="content">
        <p class="alert alert-info mb-4"><?php echo esc_html( 'Bitte mit anderen Suchbegriffen erneut versuchen:',
                    'bitski-wp-theme' ); ?></p>
        <?php get_template_part( 'templates/components/search/form' ); ?>
    </div>
</section>
