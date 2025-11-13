<?php
/**
 * Template component for displaying the no search results message.
 * Used by the search.php template when no posts are found.
 *
 * @since 0.5.21
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- Content body: no results message, search form -->
<section class="content-body search no-results">
    <header class="alert alert-primary mb-4">
        <h2><?php
            if ( is_search() ) {
                echo esc_html__( 'Es wurden leider keine Treffer gefunden.', 'bitski-wp-theme' );
            } elseif ( is_404() ) {
                echo esc_html__( 'Diese Seite wurde leider nicht gefunden.', 'bitski-wp-theme' );
            } ?></h2>
    </header>
    <div class="content">
        <p class="alert alert-info mb-4"><?php
            if ( is_search() ) {
                echo esc_html__( 'Bitte versuchen Sie es mit anderen Suchbegriffen erneut oder nutzen Sie die Seitennavigation:',
                        'bitski-wp-theme' );
            } elseif ( is_404() ) {
                echo esc_html__( 'Bitte versuchen Sie es mit der Suche oder nutzen Sie die Seitennavigation:',
                        'bitski-wp-theme' );
            } ?>
        </p>
        <?php get_template_part( 'templates/components/search/form', null, array( 'class' => 'mb-4' ) ); ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-secondary">
            <?php echo esc_html__( 'Home', 'bitski-wp-theme' ); ?>
        </a>
    </div>
</section>
