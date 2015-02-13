<?php

return [
    'mongodb' => [
        'host' => env('MONGO_HOST', 'mongodb://localhost:27017'),
        'collection' => env('MONGO_COLLECTION', 'blog'),
        'options' => [
            'password' => env('MONGO_PASSWORD', ''),
            'username' => env('MONGO_USER', '')
        ]
    ]

];
