<?php

return [
    'paths' => ['api/*', 'uploads/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'], // Your Vue app's origin
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Important to include Authorization header
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Can be false for JWT
];
