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
  // First try to get the resource from the cache.
  // If it's there, return it.
  const responseFromCache = await caches.match(request)
  if (responseFromCache) {
    return responseFromCache;
  }

  // Next try to get the resource from the network
  try {
    // Clone the request. A request is a stream and
    // can only be consumed once. Since we might need to
    // consume the request twice, we need to clone it.
    return await fetch(request.clone())
  } catch (error) {
    // Always return a Response object.
    return new Response('Network error happened', {
      status: 408,
      headers: { 'Content-Type': 'text/plain' },
    })
  }
}

// Install event - cache essential assets.
self.addEventListener('install', function (event) {
  event.waitUntil(
    addResourcesToCache([
      // Essential assets only.
      '/',
      '/style.css',
      '/assets/js/main.js'
    ])
  )
})

// Fetch event - use cache-first strategy.
self.addEventListener('fetch', function (event) {
  event.respondWith(
    cacheFirst({
      request: event.request
    })
  )
});
