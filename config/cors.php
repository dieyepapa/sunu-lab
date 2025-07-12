<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'supports_credentials' => true,

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

];