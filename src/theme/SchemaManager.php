<?php
/**
 * Theme Schema Manager.
 *
 * @since
 */

namespace BitskiWPTheme\theme;

class SchemaManager
{
    /**
     * Initialize the Schema Manager.
     */
    public function init(): void
    {
        add_action('wp_head', [$this, 'printSchema']);
    }

    public function printSchema(): void
    {

    }
}
