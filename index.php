<?php

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 *
 * @package Bitski_WP_Theme
 * @version 0.1.0
 */

echo '<div style="text-align: center;">Moin, Minchen!</div>';

while( have_posts() ) {;
    the_post();
    echo '<h1>' . get_the_title() . '</h1>';
    echo '<div>' . get_the_content() . '</div>';
}
