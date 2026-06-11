<?php

$isProduction = env('APP_ENV') === 'production';

return [
    'paths' => ['api/*', 'login', 'logout', 'refresh'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:3000')],
    'allowed_origins_patterns' => $isProduction ? [] : [
        '#^http://(localhost|127\.0\.0\.1)(:\d+)?$#',
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
