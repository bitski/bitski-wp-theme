# Maintenance and security updates – bitski‑wp‑theme

This document describes how this theme is maintained, updated, and secured over time.

## Regular maintenance

- Keep the theme compatible with the latest stable versions of WordPress and PHP.
- Test updates on a staging environment before applying them to production sites.
- Test compatibility with major WordPress block patterns and common plugin types (e.g. SEO, caching, contact forms).
- Update `CHANGELOG.md` with each new release.

## Security patches

- If a security issue is discovered:
    - Fix the issue in the `main` branch.
    - Create a new patch release tag (e.g. `v1.x.x`).
    - Document the fix in the changelog and GitHub release notes.
- Encourage users to:
    - Keep the theme updated.
    - Perform a backup before updating.

## Versioning strategy

- Follow semantic versioning (`major.minor.patch`).
- Use `v1.x.0` for new features and `v1.x.x` for bugfixes or minor improvements.
- Avoid breaking changes in `v1.x.x` releases, if possible.

## How to report security issues

- Security issues can be reported via:
    - GitHub Issues.
- Please include:
    - The theme version you are using.
    - A brief description of the issue and its potential impact.

## Recommended practices for users

- Before updating the theme:
    - Create a backup of your site.
    - Test on a staging environment, if available.
- Keep WordPress core, plugins, and PHP reasonably up to date.

## Long‑term plan

- The theme will be maintained to stay compatible with modern WordPress standards.
- Breaking changes will be documented in advance in `README.md` or release notes.
