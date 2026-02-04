/**
 * service-worker.js - service worker for offline support.
 *
 * Opt-in via theme options.
 * Uses cache-first strategy for essential assets,
 * enabling offline access and faster load times.
 *
 * @since 0.16.1
 */

const cacheName = 'bitski-wp-theme-v1'

// Add resources to cache during installation.
const addResourcesToCache = async function (resources) {
  const cache = await caches.open(cacheName)
  await cache.addAll(resources)
}

// Implement cache-first strategy for fetch events.
const cacheFirst = async function ({ request }) {
  const cache = await caches.open(cacheName);

  const cacheKey = new URL(request.url).pathname; // Ignoriere Query-Strings;

  // First try to get the resource from the cache.
  // If it's there, return it.
  const responseFromCache = await cache.match(cacheKey)
  if (responseFromCache) {
    return responseFromCache;
  }

  // Next try to get the resource from the network
  try {
    // Clone the request. A request is a stream and
    // can only be consumed once. Since we might need to
    // consume the request twice, we need to clone it.
    const responseFromNetwork = await fetch(request.clone());
    // 3. Cache die neue Antwort für zukünftige Anfragen
    await cache.put(cacheKey, responseFromNetwork.clone());
    return responseFromNetwork;
  } catch (error) {
    // Always return a Response object.
    return new Response('Network error happened', {
      status: 408,
      headers: { 'Content-Type': 'text/plain' },
    })
  }
}

// Install event - cache essential theme assets.
self.addEventListener('install', function (event) {
  event.waitUntil(
    addResourcesToCache([
      // Essential theme assets only.
      '/wp-content/themes/bitski-wp-theme/assets/css/main.css',
      '/wp-content/themes/bitski-wp-theme/assets/fonts/fontawesome/css/all.min.css',
      '/wp-content/themes/bitski-wp-theme/assets/js/main.js'
    ])
  );
  self.skipWaiting(); // Erzwinge sofortiges Update
})

self.addEventListener('activate', event => {
  event.waitUntil(self.clients.claim());
});



// Fetch event - use cache-first strategy.
self.addEventListener('fetch', function (event) {
  if (event.request.url.includes('/wp-content/themes/bitski-wp-theme/assets/')) {
    const url = new URL(event.request.url).pathname;
    console.log('🔥 FETCH GEFEUERT:', url);
    event.respondWith(
      cacheFirst({
        request: event.request,
        cacheKey: new URL(event.request.url).pathname
      })
    );
  }
});
