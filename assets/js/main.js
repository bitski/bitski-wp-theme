document.addEventListener("DOMContentLoaded", function () {
    // Color schemes
    //
    //
    function getStoredTheme() {
        return localStorage.getItem('theme');
    }

    //
    function setStoredTheme(theme) {
        return localStorage.setItem('theme', theme);
    }

    //
    function getPreferredTheme() {
        const storedTheme = getStoredTheme();
        if (storedTheme) {
            return storedTheme;
        }

        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    //
    function setTheme(theme) {
        if (theme === 'auto') {
            document.documentElement.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme);
        }
    }

    setTheme(getStoredTheme());

    function showActiveTheme(theme, focus = false) {
        const themeSwitcher = document.querySelector('#color-theme-switcher')

        if (!themeSwitcher) {
            return;
        }

        const activeThemeIcon = themeSwitcher.querySelector('.icon-active-theme');
        const activeButton = document.querySelector(`[data-bs-theme-value="${theme}"]`);
        const activeButtonIconClasses = activeButton.querySelector('i').className;

        document.querySelectorAll('[data-bs-theme-value]').forEach(function (element) {
            element.classList.remove('active');
            element.setAttribute('aria-pressed', 'false');
        })

        activeButton.classList.add('active');
        activeButton.setAttribute('aria-pressed', 'true');
        activeThemeIcon.classList.forEach(function(className) {
            if(className.startsWith('fa-')) {
                activeThemeIcon.classList.remove(className);
            }
        });
        activeThemeIcon.className += (activeThemeIcon.className ? ' ' : '') + activeButtonIconClasses;

        const ThemeSwitcherHiddenText = themeSwitcher.querySelector('.visually-hidden');
        const base = (ThemeSwitcherHiddenText.textContent.trim())
            || ((themeSwitcher.getAttribute('aria-label') || '').replace(/\s*\(.*\)\s*$/, ''))
            || 'Toggle color theme';
        themeSwitcher.setAttribute('aria-label', `${base} (${theme})`)

        if (focus) {
            themeSwitcher.focus();
        }
    }

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

// JavaScript
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
console.log('Preferred color scheme:', prefersDark ? 'dark' : 'light');

// JavaScript
console.log('storedTheme:', localStorage.getItem('theme'));
localStorage.removeItem('theme'); // zum Test