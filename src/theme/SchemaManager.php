<?php
/**
 * Theme schema manager.
 *
 * @since 0.17.0
 */

namespace BitskiWPTheme\theme;

class SchemaManager
{
    /**
     * Initializes the schema manager.
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

        if (is_home() || is_archive()) {
            $schemas[] = $this->getArchiveSchema();
        }

        // Removes empty schemas.
        $schemas = array_filter($schemas);

        // Returns early if no schemas are found.
        if (empty($schemas)) {
            return;
        }

        // Prints schemas.
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
        $schema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'url'             => home_url('/'),
            'name'            => get_bloginfo('name'),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => home_url('/?s={search_term_string}'),
                'query-input' => 'required name=search_term_string'
            ],
        ];

        return $schema;
    }

    /**
     * Gets the entity schema.
     */
    protected function getEntitySchema(): array
    {
        $entityType = apply_filters('bitski-wp-theme/option/schema/entity/type', null);
        $logoUrl    = get_theme_file_uri(apply_filters('bitski-wp-theme/option/schema/entity/logo-path', null));

        // Sets default entity type to Organization.
        if ($entityType !== 'Person') {
            $entityType = 'Organization';
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => $entityType,
            'url'      => home_url('/'),
            'name'     => get_bloginfo('name'),
            'logo'     => [
                '@type' => 'ImageObject',
                'url'   => $logoUrl,
            ]
        ];

        return $schema;
    }

    /**
     * Gets the singular schema.
     */
    protected function getSingularSchema(): array
    {
        // Post ID for singular context.
        $postId       = get_the_ID();
        $singularType = is_page() ? 'WebPage' : 'Article';

        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => $singularType,
            'url'      => get_permalink($postId),
        ];

        // Sets name || headline and datePublished properties based on singular type.
        if ($singularType === 'WebPage') {
            $schema['name'] = get_the_title($postId);
        } else {
            $schema['headline'] = get_the_title($postId);
            // Schema.org requires datePublished to be in ISO 8601 format: 'c'.
            $schema['datePublished'] = get_the_date('c', $postId);
        }

        return $schema;
    }

    /**
     * Gets the archive schema.
     */
    protected function getArchiveSchema(): array
    {
        // Queried object ID for archive context (category/tag/author/home).
        $queriedId    = get_queried_object_id();
        $archiveUrl   = is_home() ? home_url('/') : get_permalink($queriedId);
        $archiveTitle = get_the_archive_title();

        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'CollectionPage',
            'url'      => $archiveUrl,
            'name'     => $archiveTitle,
        ];

        return $schema;
    }
}
