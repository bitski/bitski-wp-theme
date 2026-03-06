# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

- Phase 11: 11.3–11.7

## [1.0.1] - 2026-03-06

### Added

- MAINTENANCE.md

### Changed

- README.md: added badges and disclaimers

## [1.0.0] - 2026-03-06

### Added

- Bootstrap 5.3 integration with 7-1 SCSS architecture and Asset Manager (Critical CSS ready)
- PHP OOP (PSR-4 autoloading) with modular `src/` namespace structure
- Load More functionality via REST API (`src/rest/LoadMore.php`)
- PWA support (manifest.json + sw.js Service Worker)
- Schema.org JSON-LD structured data (`src/theme/SchemaManager.php`)
- Full internationalization (DE/EN translations in `languages/`)
- Accessibility features (WCAG 2.1, skip links, focus styles, `prefers-reduced-motion`)
- Contact form with honeypot protection and `wp_mail()` integration
- Modular template system (`templates/components/`)

### Changed

- `.gitignore` to 2026 production standards (OS/editor files, dev tools, source maps `*.map`)
- Mobile-first CSS architecture with fluid typography (`clamp()`)
- README.md documentation styling ("and" convention consistency)

### Fixed

- PHPCS/WPCS + PSR-12 compliance (`phpcs.xml` configuration)
- Cross-browser compatibility (Chrome, Firefox, Edge)
- Contact form security (client/server validation)

### Security

- `antispambot()` protection for all public email addresses
- Contact form spam protection (honeypot + validation)

## [0.19.4] - 2026-03-04

### Added

- CHANGELOG.md (keep a Changelog format)
- README.md: JS entry point documented (`assets/js/main.js`)

### Changed

- README.md Requirements: PHPCS 3.8+ development info
