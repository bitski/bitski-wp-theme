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

        // Handle active button state.
        if (activeButton) {
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
        }

        // Update theme switcher aria-label.
        const themeSwitcherHiddenText = themeSwitcher.querySelector('.visually-hidden');
        if (themeSwitcherHiddenText) {
            const base = (themeSwitcherHiddenText.textContent.trim())
                || ((themeSwitcher.getAttribute('aria-label') || '').replace(/\s*\(.*\)\s*$/, ''))
                || 'Toggle color theme';
            themeSwitcher.setAttribute('aria-label', `${base} (${theme})`);
        }

        // Focus the theme switcher button for better accessibility.
        if (focus) {
            themeSwitcher.focus();
        }
    }

    // Initialize theme.
    const preferredTheme = getPreferredTheme();
    setTheme(preferredTheme);
    showActiveTheme(preferredTheme);

    // Listen for system theme changes.
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
        const storedTheme = getStoredTheme();
        if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
            showActiveTheme(getPreferredTheme());
        }
    })

    // Handle theme switcher clicks.
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

        // Initialize pagination colors.
        updatePaginationColors();

        // Observe changes to data-bs-theme attribute.
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
        let foundPosts = 0;
        let spinnerDelay = 0;

        // Only proceed if button and container exist.
        if (loadMoreButton && contentBody) {
            // Initialize offset, foundPosts, spinnerDelay from data attribute, representing the value of the themes posts-per-page & spinner-delay options and the total number of posts found for the current (archive) query.
            offset = parseInt(contentBody.dataset.postsPerPage) || 0;
            foundPosts = parseInt(contentBody.dataset.foundPosts) || 0;
            spinnerDelay = parseInt(contentBody.dataset.spinnerDelay) || 300;
            loadMoreButton.addEventListener('click', handleLoadMore);
        }

        async function handleLoadMore() {
            // Set ARIA attributes for live region.
            contentBody.setAttribute('aria-live', 'polite');
            contentBody.setAttribute('aria-atomic', 'false');

            // Prevent multiple clicks.
            if (loadMoreButton.disabled) {
                return;
            }
            loadMoreButton.disabled = true;

            // Set Buttons loading state.
            const originalInnerHTML = loadMoreButton.innerHTML;
            loadMoreButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...';
            loadMoreButton.setAttribute('aria-busy', 'true');
            loadMoreButton.setAttribute('aria-disabled', 'true');

            // Fetch posts from WordPress REST API.
            //
            // Set request parameters based on current offset and total number of posts found.
            const url = new URL('/wp-json/bitski-wp-theme/v1/posts/load-more', window.location.origin);
            url.searchParams.append('post_type', 'post');
            url.searchParams.append('offset', offset);
            url.searchParams.append('found_posts', foundPosts);

            let result = null;

            // Fetch posts from WordPress REST API and append them to the content body.
            try {
                // Fetch posts using url with parameters.
                //
                // Using the theme option, add a minimum delay to improve UX by preventing quick flickering of the button.
                // Promise.all() ensures that both requests are executed concurrently.
                const responses = await Promise.all([
                    fetch(url.toString()),
                    new Promise(resolve => setTimeout(resolve, spinnerDelay))
                ]);

                // Retrieve fetch response from Promise.all array.
                const response = responses[0];

                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }

                // Append posts to content body.
                result = await response.json();
                if (result.posts_html && result.posts_html.length > 0) {
                    contentBody.insertAdjacentHTML('beforeend', result.posts_html.join(''));
                    offset = result.offset;
                }
            } catch (error) {
                console.error(error.message);
            } finally {
                if (result && !result.has_more) {
                    // Reset ARIA attributes for live region.
                    contentBody.removeAttribute('aria-live');
                    contentBody.removeAttribute('aria-atomic');

                    // Hide the button if there are no more posts to load.
                    loadMoreButton.classList.add('d-none');
                } else {
                    // Reset button state.
                    loadMoreButton.innerHTML = originalInnerHTML;
                    loadMoreButton.disabled = false;
                    loadMoreButton.removeAttribute('aria-busy');
                    loadMoreButton.removeAttribute('aria-disabled');
                }
            }
        }
    }
});
