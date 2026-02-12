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
        add_action('wp_head', [$this, 'printSchemas']);
    }

    /**
     * Prints the JSON-LD schemas.
     */
    public function printSchemas(): void
    {
        $schemas = [];

        // Core schemas.
        $schemas[] = $this->getWebsiteSchema();
        $schemas[] = $this->getEntitySchema();

        // Conditional schemas.
        if (is_singular()) {
            $schemas[] = $this->getSingularSchema();
        }

        if ( is_home() || is_archive()) {
            $schemas[] = $this->getArchiveSchema();
        }

        // Remove empty schemas.
        $schemas = array_filter($schemas);

        // Return early if no schemas are found.
        if (empty($schemas)) {
            return;
        }

        // Print schemas.
        echo "\n<!-- Schema.org JSON-LD -->\n";
        foreach ($schemas as $schema) {
            echo '<script type="application/ld+json">' .
                 wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
                 "</script>\n";
        }
    }

    protected function getWebsiteSchema(): array
    {
        return [];
    }

    protected function getEntitySchema(): array
    {
        return [];
    }

    protected function getSingularSchema(): array
    {
        return [];
    }

    protected function getArchiveSchema(): array
    {
        return [];
    }
}
