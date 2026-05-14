<?php
/**
 * Template component for displaying the search form.
 *
 * @since 0.5.25
 */

// Exits if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

$searchBarInputId = 'search-bar-input';
$context          = ! empty($args['context']) ? $args['context'] : '';
$class            = ! empty($args['class']) ? $args['class'] : '';
if ( ! empty($context)) {
    $searchBarInputId .= "-" . $context;
}
?>

<form role="search" method="get" class="search-form <?php
echo esc_attr($class); ?>"
      action="<?php
      echo esc_url(home_url('/')); ?>">
    <label for="<?php
    echo $searchBarInputId; ?>" class="visually-hidden"><?php
        echo esc_html__('Suche', 'bitski-wp-theme'); ?></label>
    <div class="input-group">
        <input id="<?php
        echo $searchBarInputId; ?>" class="search-bar-input form-control" type="search" name="s"
               value="<?php
               echo get_search_query(); ?>"
               placeholder="<?php
               echo esc_attr__('Suchen', 'bitski-wp-theme'); ?> …">
        <button class="search-bar-submit btn btn-outline-secondary" type="submit" aria-label="<?php
        echo esc_attr__('Suche absenden', 'bitski-wp-theme'); ?>">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </button>
    </div>
</form>
