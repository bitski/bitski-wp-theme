<?php
/**
 * The template component for displaying the search form.
 *
 * @since 0.5.25
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="search-bar-input" class="visually-hidden">Suche</label>
    <div class="input-group">
        <input type="search" id="search-bar-input" class="search-bar-input form-control"
               placeholder="Suchen …" value="<?php echo get_search_query(); ?>" name="s">
        <button type="submit" class="search-bar-submit btn btn-outline-secondary"
                aria-label="Suche absenden">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </button>
    </div>
</form>
