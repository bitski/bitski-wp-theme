<?php
/**
 * Template component for displaying the search form.
 *
 * @since 0.5.25
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

$class = ! empty($args['class']) ? $args['class'] : '';
?>

<form role="search" method="get" class="search-form <?php
echo esc_attr($class); ?>"
      action="<?php
      echo esc_url(home_url('/')); ?>">
    <label for="search-bar-input" class="visually-hidden"><?php
        echo esc_html__('Suche', 'bitski-wp-theme'); ?></label>
    <div class="input-group">
        <input id="search-bar-input" class="search-bar-input form-control" type="search" name="s"
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
