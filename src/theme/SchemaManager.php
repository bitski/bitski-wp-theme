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
     * Initializes the Schema Manager.
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

        // Core schemas
        $schemas[] = $this->getWebsiteSchema();
        $schemas[] = $this->getEntitySchema();

        // Conditional schemas
        if (is_singular()) {
            $schemas[] = $this->getSingularSchema();
        }

        if ( is_home() || is_archive()) {
            $schemas[] = $this->getArchiveSchema();
        }

        // Removes empty schemas.
        $schemas = array_filter($schemas);

        // Returns early if no schemas are found.
        if (empty($schemas)) {
            return;
        }

        // Prints schemas
        echo "\n<!-- Schema.org JSON-LD -->\n";
        foreach ($schemas as $schema) {
            echo '<script type="application/ld+json">' .
                 wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
                 "</script>\n";
        }
    }

    /**
     * Gets the website schema.
     */
    protected function getWebsiteSchema(): array
    {
        return [];
    }

    /**
     * Gets the entity schema.
     */
    protected function getEntitySchema(): array
    {
        return [];
    }

    /**
     * Gets the singular schema.
     */
    protected function getSingularSchema(): array
    {
        return [];
    }

    /**
     * Gets the archive schema.
     */
    protected function getArchiveSchema(): array
    {
        return [];
    }
}
