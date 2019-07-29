<?php

//declare the manifest.json
return [
    'name' => 'événements!',
    'manifest' => [
        'name' => env('APP_NAME', 'événements!'),
        'short_name' => 'événements!',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'icons' => [
            '72x72' => '/img/PWA/icon-72x72.png',
            '96x96' => '/img/PWA//icon-96x96.png',
            '128x128' => '/img/PWA/icon-128x128.png',
            '144x144' => '/img/PWA/icon-144x144.png',
            '152x152' => '/img/PWA/icon-152x152.png',
            '192x192' => '/img/PWA/icon-192x192.png',
            '384x384' => '/img/PWA/icon-384x384.png',
            '512x512' => '/img/PWA/icon-512x512.png'
        ],
        'splash' => [
            '640x1136' => '/img/PWA/splash-640x1136.png',
            '750x1334' => '/img/PWA/splash-750x1334.png',
            '828x1792' => '/img/PWA/splash-828x1792.png',
            '1125x2436' => '/img/PWA/splash-1125x2436.png',
            '1242x2208' => '/img/PWA/splash-1242x2208.png',
            '1242x2688' => '/img/PWA/splash-1242x2688.png',
            '1536x2048' => '/img/PWA/splash-1536x2048.png',
            '1668x2224' => '/img/PWA/splash-1668x2224.png',
            '1668x2388' => '/img/PWA/splash-1668x2388.png',
            '2048x2732' => '/img/PWA/splash-2048x2732.png',
        ],
        'custom' => []
    ]
];
