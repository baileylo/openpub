<?php

return [
    'proxy' => [
        'dir' => base_path('/Blog/Storage/proxy'),
        'namespace' => 'Baileylo\Blog\Storage\Proxy'
    ],

    'hydrator' => [
        'dir' => base_path('/Blog/Storage/Hydrators'),
        'namespace' => 'Baileylo\Blog\Storage\Hydrators'
    ],

    'metadata' => [
        'dir' => base_path('/Blog/config'),
        'extension' => '.yml'
    ]
];
