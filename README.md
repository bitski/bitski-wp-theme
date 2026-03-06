# bitski-wp-theme

[![Version](https://img.shields.io/github/v/release/bitski/bitski-wp-theme?sort=semver)](https://github.com/bitski/bitski-wp-theme/releases)
[![License](https://img.shields.io/github/license/bitski/bitski-wp-theme)](LICENSE)
[![WordPress](https://img.shields.io/badge/WordPress-6.5%2B-blue)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-red)](https://www.php.net)

Modern WordPress starter theme integrating Bootstrap 5.3, a 7-1 SCSS architecture and PHP OOP principles for
high-performance development.

Classic theme | Block editor ready | v1.0.1 | GPL v3+

## Disclaimer

This theme is provided "as is", without warranty of any kind, either expressed or implied. The author is not liable for
any damages arising from its use. Use at your own risk.

## ✨ Features

- Bootstrap 5.3 integration + 7-1 SCSS architecture + Asset Manager (Critical CSS ready)
- PHP OOP (PSR-4) + Composer autoload (`src/`)
- Load More via REST API
- PWA-ready (includes a Manifest and Service Worker setup)
- SEO-first approach: Schema.org JSON-LD and theme.json configuration
- i18n-ready (DE/EN) + Accessibility (WCAG 2.1)

## 🚀 Quick start

### Clone and install

```bash
cd wp-content/themes
git clone https://github.com/bitski/bitski-wp-theme.git
cd bitski-wp-theme
composer install  # PSR-4 autoloader (autoloads src/ as Bitski\Theme\)
```

### Activate

Appearance → Themes

### Development (watch)

```bash
sass assets/scss/main.scss:assets/css/main.css --watch
esbuild assets/js/main.js --bundle --watch --outfile=assets/js/main.js
```

### Build (production)

```bash
sass assets/scss/main.scss:assets/css/main.css --style=compressed
esbuild assets/js/main.js --bundle --minify --outfile=assets/js/main.min.js
```

### Quality checks

vendor/bin/phpcs

## 📋 Requirements

### Server

- PHP 8.1+ (getestet bis PHP 8.4)
- WordPress 6.5+ (Full Site Editing ready)
- MySQL 5.7+ / MariaDB 10.4+

### Development

- Composer 2.7+
- Node.js 18+ / 20 LTS
- npm 9+ / yarn 1.22+
- sass, esbuild
- PHPCS 3.8+ (phpcs.xml inklusive, PSR-12)

## 📁 Structure

### Entry points

SCSS (7-1): `assets/scss/main.scss`
JS (ESM): `assets/js/main.js`
PHP: `src/` (PSR-4) → `src/theme/` (Config → Hooks → Setup → PWA → Schema)

### Directory structure

```
├── src/              # PHP PSR-4 (Bitski\Theme*)
│   ├── theme/        # Core: Config → Hooks → Setup → PWA → Schema
│   ├── assets/       # Asset Manager (Critical CSS)
│   ├── content/      # Blocks, Post Types (Stubs ready)
│   ├── forms/        # Contact Form Handler (active)
│   ├── rest/         # Load More API (active)
│   └── walkers/      # Bootstrap NavWalker (active)
├── assets/scss/      # 7-1 Sass Architecture
│   ├── abstracts/    # Variables, Mixins, Functions etc.
│   ├── base/         # Reset, Typography etc.
│   ├── components/   # Button, Card, Grid etc.
│   ├── layout/       # Header, Footer, Main etc.
│   ├── pages/        # Home, Static Pages etc.
│   ├── themes/       # Theme Styles (Block Editor etc.)
│   └── vendors/      # Vendor Config (Bootstrap etc.)
├── templates/        # Modular Parts System
├── languages/        # i18n (DE/EN ready)
└── theme.json        # Block Editor Config
```

## 👤 Author

Peter Eckerle (bitski.de)  
[Website](https://bitski.de) | [GitHub](https://github.com/bitski)
