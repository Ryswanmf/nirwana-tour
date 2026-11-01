const CACHE_NAME = 'nirwana-tour-v12';
const PRECACHE_ASSETS = [
  '/',
  '/css/style.css',
  '/css/style.min.css',
  '/js/script.js',
  '/js/script.min.js',
  '/js/alpine.min.js',
  '/assets/logo/Logo-Nirwana.png',
  '/assets/images/hero-right.webp',
  '/assets/images/hero/dieng-hero.webp'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(PRECACHE_ASSETS))
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys.map((key) => {
          if (key !== CACHE_NAME) {
            return caches.delete(key);
          }
        })
      );
    })
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  // Only handle GET requests and skip admin, auth or dynamic form submissions
  if (
    event.request.method !== 'GET' || 
    event.request.url.includes('/admin') || 
    event.request.url.includes('/login') ||
    event.request.url.includes('/inquiry')
  ) {
    return;
  }

  const isNavigation = event.request.mode === 'navigate' || event.request.destination === 'document';

  if (isNavigation) {
    // Network-First for HTML navigation so users always see fresh packages & articles
    event.respondWith(
      fetch(event.request)
        .then((networkResponse) => {
          if (networkResponse && networkResponse.status === 200) {
            const responseClone = networkResponse.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(event.request, responseClone));
          }
          return networkResponse;
        })
        .catch(() => {
          return caches.match(event.request).then((cachedResponse) => {
            return cachedResponse || caches.match('/');
          });
        })
    );
    return;
  }

  // Cache-First with Network fallback for static assets (CSS, JS, images, fonts)
  event.respondWith(
    caches.match(event.request).then((cachedResponse) => {
      if (cachedResponse) {
        return cachedResponse;
      }
      return fetch(event.request).then((networkResponse) => {
        if (networkResponse && networkResponse.status === 200) {
          const responseClone = networkResponse.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(event.request, responseClone));
        }
        return networkResponse;
      });
    })
  );
});
