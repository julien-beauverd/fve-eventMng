var staticCacheName = "pwa-v" + new Date().getTime();

//files that are accessible when the user is offline
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/img/PWA/icon-72x72.png',
    '/img/PWA/icon-96x96.png',
    '/img/PWA/icon-128x128.png',
    '/img/PWA/icon-144x144.png',
    '/img/PWA/icon-152x152.png',
    '/img/PWA/icon-192x192.png',
    '/img/PWA/icon-384x384.png',
    '/img/PWA/icon-512x512.png',
    '/img/exclamation-droite.png',
    '/img/fleche-verte.png',
    '/img/logo.png',
    '/img/exclamation-gauche.png',
    '/',
    '/bootstrap-4.3.1-dist/css/bootstrap.min.css',
    '/bootstrap-4.3.1-dist/js/bootstrap.min.js',
];

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                .filter(cacheName => (cacheName.startsWith("pwa-")))
                .filter(cacheName => (cacheName !== staticCacheName))
                .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
        .then(cache => {
            return cache.addAll(filesToCache);
        })
    )
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
        .then(response => {
            return response || fetch(event.request);
        })
        .catch(() => {
            return caches.match('offline');
        })
    )
});
