<?php
/**
 * Template component for displaying footer columns.
 *
 * @since 0.5.6
 */

// Exit if accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}
?>

<section class="footer-columns border-top py-5">
    <div class="<?php
    echo apply_filters('bitski-wp-theme/class/container', ['container-xl'], true); ?>">
        <div class="row">
            <div class="col-6 col-lg-3 mb-4 mb-lg-0">
                <h2 class="h5"><?php
                    echo esc_html__('Headline 1', 'bitski-wp-theme'); ?></h2>
                <ul class="list-unstyled mb-0">
                    <li><a href="#"><?php
                            echo esc_html__('Link 1.1', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 1.2', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 1.3', 'bitski-wp-theme'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3 mb-4 mb-lg-0">
                <h2 class="h5"><?php
                    echo esc_html__('Headline 2', 'bitski-wp-theme'); ?></h2>
                <ul class="list-unstyled mb-0">
                    <li><a href="#"><?php
                            echo esc_html__('Link 2.1', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 2.2', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 2.3', 'bitski-wp-theme'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h2 class="h5"><?php
                    echo esc_html__('Headline 3', 'bitski-wp-theme'); ?></h2>
                <ul class="list-unstyled mb-0">
                    <li><a href="#"><?php
                            echo esc_html__('Link 3.1', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 3.2', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 3.3', 'bitski-wp-theme'); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h2 class="h5"><?php
                    echo esc_html__('Headline 4', 'bitski-wp-theme'); ?></h2>
                <ul class="list-unstyled mb-0">
                    <li><a href="#"><?php
                            echo esc_html__('Link 4.1', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 4.2', 'bitski-wp-theme'); ?></a></li>
                    <li><a href="#"><?php
                            echo esc_html__('Link 4.3', 'bitski-wp-theme'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
