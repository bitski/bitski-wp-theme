<?php
/**
 * Theme PWA manager.
 * Handles Progressive Web App (PWA) features for the theme.
 * Registers the PWA manifest and service worker for offline support and assets caching.
 *
 * @since 0.16.0
 */

namespace BitskiWPTheme\theme;

class ThemePWAManager
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
          const registerServiceWorker = async () => {
            if ('serviceWorker' in navigator) {
              try {
                const registration = await navigator.serviceWorker.register(
                  'sw.js',
                  {
                    scope: '<?php echo esc_url(get_template_directory_uri() . '/' ) ; ?>'
                  }
                )
                if (registration.installing) {
                  console.log('Service worker installing')
                } else if (registration.waiting) {
                  console.log('Service worker installed')
                } else if (registration.active) {
                  console.log('Service worker active')
                }
              } catch (error) {
                console.error(`Registration failed with ${error}`)
              }
            }
          }
        </script>
        <?php
    }
}
