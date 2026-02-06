<?php
/**
 * Theme PWA manager - webserver independent.
 * Handles Progressive Web App (PWA) features for the theme.
 * Registers the PWA manifest and service worker for offline support and assets caching.
 *
 * Service worker pattern based on MDN simple service worker demo.
 *
 * @since 0.16.0
 */

namespace BitskiWPTheme\theme;

class PWAManager
{
    /**
     * Initialize the PWA manager.
     */
    public function init(): void
    {
        add_action('wp_head', [$this, 'registerPWAManifest']);
        add_action('wp_footer', [$this, 'registerServiceWorker']);
    }

    /**
     * Register the PWA manifest link in the head.
     */
    public function registerPWAManifest(): void
    {
        $manifestUrl = get_template_directory_uri().'/manifest.json';
        $themeColor  = '#0d6efd';
        echo '<link rel="manifest" href="'.esc_url($manifestUrl).'">';
        echo '<meta name="theme-color" content="'.esc_attr($themeColor).'">';
    }

    /**
     * Register the service worker script in the footer.
     */
    public function registerServiceWorker(): void
    { ?>
        <script>
          const registerServiceWorker = async function () {
            if ('serviceWorker' in navigator) {
              try {
                const themeUri = '<?php echo esc_url(get_template_directory_uri()); ?>'
                const registration = await navigator.serviceWorker.register(
                  `${themeUri}/sw.js`,
                  {
                    scope: `${themeUri}/`,
                  }
                )

                <?php if (WP_DEBUG) { ?>
                    console.log('Service worker registered with scope:', registration.scope)
                    if (registration.installing) {
                      console.log('Service worker installing')
                    } else if (registration.waiting) {
                      console.log('Service worker installed')
                    } else if (registration.active) {
                      console.log('Service worker active')
                    }
                <?php } ?>
              } catch (error) {
                console.error(`Registration failed with ${error}`)
              }
            }
          }

          // Register the service worker when the page loads.
          window.addEventListener('load', registerServiceWorker)
        </script>
        <?php
    }
}
