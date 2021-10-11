const cacheName = 'v1';

const cacheAssets = [
    'index.html',
    'index.css',
    'style.css',
    'shindan.html',
    'shindan.css',
    'shindan.js',
    'professors_file',
    'kuchikomi.css'
];

self.addEventListener('install', async (ev) => {
    console.log("SW: install eventが発火");
    ev.waitUntil((async () => {
        //キャッシュのファイルを開く
        const cache = await caches.open(cacheName);
        //必要最低限のキャッシュを読み込む
        cache.addAll(cacheAssets);
        return self.skipWaiting();
    })());
});

self.addEventListener('activate', async (ev) => {
    console.log("SW: activate eventが発火");
    ev.waitUntil((async (ev) => {
        //cacheの中身を探す
        const keys = await caches.keys();
        console.log(keys);
        //古いキャッシュを探す
        const targets = keys.filter(key => key !== cacheName);
        console.log(targets);
        //古いキャッシュを消す
        return Promise.all(targets.map(target => caches.delete(targets)));
    })());
});

self.addEventListener('fetch', async (ev) => {
    ev.respondWith((async () => {
        const hit = await caches.match(ev.request);
        //キャッシュがあれば探す
        if (hit) {
            return hit;
        }
        //なければ取りに行く
        try {
            const res = await fetch(ev.request);
            const resClone = res.clone();
            const cache = await caches.open(cacheName);
            cache.put(ev.request, resClone);
            return res;
        } catch(error) {
            return new Response(error);
        }
    })());
});