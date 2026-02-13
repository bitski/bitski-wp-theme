/**
 * service-worker.js - service worker for offline support.
 *
 * Opt-in via theme options.
 * Uses cache-first strategy for essential theme assets,
 * enabling offline access and faster load times.
 *
 * @since 0.16.1
 */

const cacheName = 'bitski-wp-theme-v1'

// Adds resources to cache during installation.
const addResourcesToCache = async function (resources) {
  const cache = await caches.open(cacheName)
  await cache.addAll(resources)
}

// Implements cache-first strategy for fetch events.
const cacheFirst = async function ({ request }) {
  const cache = await caches.open(cacheName)

  const cacheKey = new URL(request.url).pathname // Ignoriere Query-Strings;

  // First tries to get the resource from the cache.
  // If it's there, returns it.
  const responseFromCache = await cache.match(cacheKey)
  if (responseFromCache) {
    return responseFromCache
  }

  // Next tries to get the resource from the network
  try {
    // Clones the request. A request is a stream and
    // can only be consumed once. Since we might need to
    // consume the request twice, we need to clone it.
    const responseFromNetwork = await fetch(request.clone())

    // Caches the new responseFromNetwork for future requests.
    await cache.put(cacheKey, responseFromNetwork.clone())

    return responseFromNetwork
  } catch (error) {
    // Always return a Response object.
    return new Response('Network error happened', {
      status: 408,
      headers: { 'Content-Type': 'text/plain' },
    })
  }
}

// Install event - caches essential theme assets.
self.addEventListener('install', function (event) {
  event.waitUntil(
    addResourcesToCache([
      // Theme styles.
      '/wp-content/themes/bitski-wp-theme/style.css',
      '/wp-content/themes/bitski-wp-theme/assets/css/main.css',
      '/wp-content/themes/bitski-wp-theme/assets/fonts/fontawesome/css/all.min.css',

      // Theme scripts.
      '/wp-content/themes/bitski-wp-theme/assets/js/main.js',
      '/wp-content/themes/bitski-wp-theme/assets/js/lib/bootstrap.bundle.min.js',

      // Theme images.
      '/wp-content/themes/bitski-wp-theme/assets/img/bitski-wp-theme-logo_30x30.svg',
      '/wp-content/themes/bitski-wp-theme/assets/img/bitski-wp-theme-logo_50x50.svg',
      '/wp-content/themes/bitski-wp-theme/assets/img/bitski-wp-theme-logo-dark_30x30.svg',
      '/wp-content/themes/bitski-wp-theme/assets/img/bitski-wp-theme-logo-dark_50x50.svg',

      // Theme fonts.
      // Bootstrap/SCSS/Custom WOFF2s are already cached dynamically via fetch handler.

      // PWA assets.
      '/wp-content/themes/bitski-wp-theme/manifest.json',
      '/wp-content/themes/bitski-wp-theme/sw.js'
    ])
  )

  // Forces immediate update on install.
  self.skipWaiting()
})

// Activate event - activates new service worker.
self.addEventListener('activate', event => {
  event.waitUntil(self.clients.claim())
})

// Fetch event - uses cache-first strategy.
self.addEventListener('fetch', function (event) {
  const url = new URL(event.request.url)

  if (url.pathname.startsWith('/wp-content/themes/bitski-wp-theme/')) {
    event.respondWith(
      cacheFirst({
        request: event.request
      })
    )
  }
})
