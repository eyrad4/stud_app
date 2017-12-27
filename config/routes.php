<?php

return [
    'home' => [
        'handler' => 'Controller@home',
        'path' => '/'
    ],
    'index' => [
        'handler' => 'ProductController@index',
        'path' => '/products'
    ],
    'product_show' => [
        'handler' => 'ProductController@show',
        'path' => '/products/{id}',
        'method' => 'GET'
    ],
    'product_create' => [
        'handler' => 'ProductController@create',
        'path' => '/products/{id}',
        'method' => 'POST'
    ],
];