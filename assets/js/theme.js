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
        if (theme === 'auto') {
            document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme);
        }
    }

    setTheme(getStoredTheme());

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

        const ThemeSwitcherHiddenText = themeSwitcher.querySelector('.visually-hidden'),
            base = (ThemeSwitcherHiddenText.textContent.trim())
                || ((themeSwitcher.getAttribute('aria-label') || '').replace(/\s*\(.*\)\s*$/, ''))
                || 'Toggle color theme';
        themeSwitcher.setAttribute('aria-label', `${base} (${theme})`);

        if (focus) {
            themeSwitcher.focus();
        }
    }

    //
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
        const storedTheme = getStoredTheme()
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
        }
    })

    showActiveTheme(getPreferredTheme());

    document.querySelectorAll('[data-bs-theme-value]')
        .forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const theme = toggle.getAttribute('data-bs-theme-value')
                setStoredTheme(theme)
                setTheme(theme)
                showActiveTheme(theme, true)
            })
        })
});
