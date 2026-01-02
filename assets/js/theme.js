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

        const activeThemeIcon = themeSwitcher.querySelector('.icon-active-theme');
        const activeButton = document.querySelector(`[data-bs-theme-value="${theme}"]`);
        const activeButtonIconClasses = activeButton.querySelector('i').className;

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

        const themeSwitcherHiddenText = themeSwitcher.querySelector('.visually-hidden');
        const base = (themeSwitcherHiddenText.textContent.trim())
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
     *
     * Handle search bar toggler and input focus.
     * Closes search bar when clicking outside of it.
     */
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

        // Close search bar when clicking outside of it
        document.addEventListener('click', function (event) {
            if (!searchBar.contains(event.target) && !searchBarToggler.contains(event.target)) {
                // Get Bootstrap API Collapse instance
                const bsCollapse = bootstrap.Collapse.getInstance(searchBar);

                if (bsCollapse && searchBar.classList.contains('show')) {
                    bsCollapse.hide();
                }
            }
        });
    }


    /**
     * [03] Pagination
     *
     * Update pagination link colors based on current color theme.
     * This ensures pagination links are visible in both light and dark modes.
     */
    const pagination = document.querySelector('.pagination');
    if (pagination) {
        const updatePaginationColors = function () {
            const theme = document.documentElement.getAttribute('data-bs-theme');
            document.querySelectorAll('.pagination li:not(.active) .page-link').forEach(function (link) {
                if (theme === 'dark') {
                    link.classList.remove('text-dark');
                    link.classList.add('text-light');
                } else {
                    link.classList.remove('text-light');
                    link.classList.add('text-dark');
                }
            });
        };

        // Initialize pagination colors
        updatePaginationColors();

        // Observe changes to data-bs-theme attribute
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                if (mutation.attributeName === 'data-bs-theme') {
                    updatePaginationColors();
                }
            });
        });
        observer.observe(document.documentElement, {attributes: true});
    }


    /**
     * [04] Load more
     *
     * Handle "Load More" button functionality via WordPress REST API at archive pages.
     * Clicking it will fetch the next batch of posts and append it after the current list.
     */
    const bodyClassList = document.body.classList;
    if (bodyClassList.contains('archive') || bodyClassList.contains('blog')) {
        const contentBody = document.querySelector('.content-body');
        const loadMoreButton = document.querySelector('.load-more');
        let offset = 0;

        // Only proceed if button and container exist.
        if (loadMoreButton && contentBody) {
            offset = parseInt(contentBody.dataset.offset) || 0;
            loadMoreButton.addEventListener('click', handleLoadMore);
        }

        async function handleLoadMore() {
            console.log('load handleLoadMore');
            // Prevent multiple clicks
            if (loadMoreButton.disabled) {
                return;
            }
            loadMoreButton.disabled = true;
            loadMoreButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...';

            const url = new URL('/wp-json/bitski-wp-theme/v1/posts/load-more', window.location.origin);
            url.searchParams.append('post_type', 'post');
            url.searchParams.append('offset', offset);

            try {
                const response = await fetch(url.toString());
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                const result = await response.json();
                if (result.posts_html && result.posts_html.length > 0) {
                    contentBody.insertAdjacentHTML('beforeend', result.posts_html.join(''));
                    offset = result.offset;
                } else {
                    loadMoreButton.innerHTML = 'No more posts to load.';
                }
                loadMoreButton.disabled = false;
                console.log(result);
                // console.log(response.headers.get("content-type"));
            } catch (error) {
                console.error(error.message);
            }
        }
    }
});
