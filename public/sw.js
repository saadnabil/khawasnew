self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open('dashboard-cache').then(function(cache) {
            return cache.addAll([
                '/',
                '/css/app.css',  // Add other CSS, JS, and image files
                '/js/app.js',
                '/offline',
                '/images/icons/icon-192x192.png'
            ]);
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        }).catch(function() {
            return caches.match('/offline');
        })
    );
});
