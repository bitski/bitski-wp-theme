```markdown
# bitski-wp-theme

Modern WordPress starter theme with Bootstrap 5.3 integration, 7-1 SCSS architecture, and PHP OOP for high-performance projects.

**Classic/Hybrid Theme** | **v0.19.0** | **GPL v3+**

## ✨ Features
- Bootstrap 5.3 integration + 7-1 SCSS architecture + Asset Manager (Critical CSS ready)  
- PHP OOP (PSR-4) + Composer autoload (`src/`)  
- Load More via REST API  
- PWA-ready (Manifest + Service Worker)  
- SEO-First: Schema.org JSON-LD + theme.json  
- i18n-ready (DE/EN) + Accessibility (WCAG 2.1)

## 🚀 Quick Start

```bash
cd wp-content/themes
git clone https://github.com/bitski/bitski-wp-theme.git
cd bitski-wp-theme
composer install
```

→ Activate theme under **Appearance → Themes**.

## 🛠️ Development

**SCSS (7-1):** `assets/scss/main.scss`  
**PHP:** `src/` (PSR-4) → `src/theme/` (Config → Hooks → Setup → PWA → Schema)

**Commands:**
- `composer install`     # Autoload src/ → Bitski\Theme\
- `vendor/bin/phpcs`     # PSR-12

## 📁 Structure
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
**Peter Eckerle (bitski)**  
[GitHub](https://github.com/bitski)
```
