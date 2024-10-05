<?php

return [
    'user' => [
        'uploads' => [
            'img' => [
                'path' => 'uploads/user/img/',
                'default' => 'default/user_avatar.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
    'products' => [
        'uploads' => [
            'imgs' => [
                'path' => 'uploads/products/imgs/',
                'default' => 'default/product.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
    'images' => [
        'uploads' => [
            'img' => [
                'path' => 'uploads/images/img/',
                'default' => 'default/place_holder.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
    'main' => [
        'uploads' => [
            'img' => [
                'path' => 'uploads/main/img/',
                'default' => 'default/place_holder.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
            'icon' => [
                'path' => 'uploads/main/icon/',
                'default' => 'default/place_holder.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
    'branch' => [
        'uploads' => [
            'img' => [
                'path' => 'uploads/branch/img/',
                'default' => 'default/branch_avatar.jpg',
                'image' => [
                    'min_resolution' => 100,
                    'store_resolution' => 150,
                    'max_file_size_kb' => 5000,
                ],
            ],
        ],
    ],
];
