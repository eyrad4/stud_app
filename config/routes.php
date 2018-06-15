<?php

return [
    'home' => [
        'handler' => 'App\Controllers\Controller@home',
        'path' => '/'
    ],
    'index' => [
        'handler' => 'App\Controllers\ProductController@index',
        'path' => '/products'
    ],
    'product_show' => [
        'handler' => 'App\Controllers\ProductController@show',
        'path' => '/product/{id}',
        'method' => 'GET'
    ],
    'product_create' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/create',
        'method' => 'POST',
        'acl' => ['user', 'admin']
    ],
    'login' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@login',
        'path' => '/login',
        'method' => 'POST',
    ],
    'user_create' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@register',
        'path' => '/register',
        'method' => 'POST',
    ],
    'logout' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@logout',
        'path' => '/logout',
        'method' => 'POST',
    ],
    'reset_password' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@resetpassword',
        'path' => '/resetpass',
        'method' => 'POST',
    ],
    'user_info' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@userinfo',
        'path' => '/userinfo',
        'method' => 'POST',
    ],
    'categories_list' => [
        'handler' => 'App\Controllers\CategoryController@categoryList',
        'path' => '/allcategories',
        'method' => 'GET',
    ]
];