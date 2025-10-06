/**
 * theme.js - core theme functionality.
 *
 * Handles core theme features such as color schemes (sets data-bs-theme).
 *
 * @since 0.5.11
 */
document.addEventListener("DOMContentLoaded", function () {
    /**
     * [01] Color theme switcher
     */
    function getStoredTheme() {
        return localStorage.getItem('theme');
    }

    function setStoredTheme(theme) {
        return localStorage.setItem('theme', theme);
    }

    function getPreferredTheme() {
        const storedTheme = getStoredTheme();
        if (storedTheme) {
            return storedTheme;
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function setTheme(theme) {
        let appliedTheme = theme;
        if (appliedTheme === 'auto') {
            appliedTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        document.documentElement.setAttribute('data-bs-theme', appliedTheme);
        setLogos(appliedTheme);
    }

    function setLogos(theme) {
        const logosLight = document.querySelectorAll('.logo-light');
        const logosDark = document.querySelectorAll('.logo-dark');

        if (logosLight.length > 0 && logosDark.length > 0) {
            logosLight.forEach(function (logo) {
                logo.classList.toggle('d-none', theme === 'dark');
            });
            logosDark.forEach(function (logo) {
                logo.classList.toggle('d-none', theme === 'light');
            })
        }
    }

    /**
     * Updates the UI to reflect the active theme and optionally focuses the theme switcher control.
     *
     * @param {string} theme - The name of the active theme to display.
     * @param {boolean} [focus=false] - Determines whether to focus the theme switcher control after updating the theme.
     * @return {void} Does not return a value.
     */
    function showActiveTheme(theme, focus = false) {
        const themeSwitcher = document.querySelector('#color-theme-switcher');

        if (!themeSwitcher) {
            return;
        }

        const activeThemeIcon = themeSwitcher.querySelector('.icon-active-theme'),
            activeButton = document.querySelector(`[data-bs-theme-value="${theme}"]`),
            activeButtonIconClasses = activeButton.querySelector('i').className;

        document.querySelectorAll('[data-bs-theme-value]').forEach(function (element) {
            element.classList.remove('active');
            element.setAttribute('aria-pressed', 'false');
        })

        activeButton.classList.add('active');
        activeButton.setAttribute('aria-pressed', 'true');
        activeThemeIcon.classList.forEach(function (className) {
            if (className.startsWith('fa-')) {
                activeThemeIcon.classList.remove(className);
            }
        });
        activeThemeIcon.className += (activeThemeIcon.className ? ' ' : '') + activeButtonIconClasses;

        const themeSwitcherHiddenText = themeSwitcher.querySelector('.visually-hidden'),
            base = (themeSwitcherHiddenText.textContent.trim())
                || ((themeSwitcher.getAttribute('aria-label') || '').replace(/\s*\(.*\)\s*$/, ''))
                || 'Toggle color theme';
        themeSwitcher.setAttribute('aria-label', `${base} (${theme})`);

        if (focus) {
            themeSwitcher.focus();
        }
    }

    // Initialize theme
    setTheme(getPreferredTheme());
    showActiveTheme(getPreferredTheme());

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
        const storedTheme = getStoredTheme();
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
            showActiveTheme(getPreferredTheme());
        }
    })

    // Handle theme switcher clicks
    document.querySelectorAll('[data-bs-theme-value]')
        .forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const theme = toggle.getAttribute('data-bs-theme-value')
                setStoredTheme(theme)
                setTheme(theme)
                showActiveTheme(theme, true)
            })
        })


    /**
     * [02] Search
     */
    // Handle focus on search bar input and back to toggler button
    const searchBarToggler = document.querySelector('.search-bar-toggler');
    const searchBar = document.querySelector('.search-bar');
    const searchBarInput = document.querySelector('.search-bar-input');

    if (searchBarToggler && searchBar && searchBarInput) {
        searchBar.addEventListener('shown.bs.collapse', function () {
            searchBarInput.focus({preventScroll: true});
        });

        searchBar.addEventListener('hidden.bs.collapse', function () {
            searchBarToggler.focus({preventScroll: true});
        });
    }
});
