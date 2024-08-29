<?php

/** @var array $params */

return [
    'class' => 'yii\web\UrlManager',
    //'hostInfo' => $params['backendHostInfo'],
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        'profile' => 'user/profile/index',
        'POST oauth2/<action:\w+>' => 'oauth2/rest/<action>',

        'GET shop/products/<id:\d+>' => 'shop/product/view',
        'GET shop/products/category/<id:\d+>' => 'shop/product/category',
        'GET shop/products/brand/<id:\d+>' => 'shop/product/brand',
        'GET shop/products/tag/<id:\d+>' => 'shop/product/tag',
        'GET shop/products' => 'shop/product/index',
        'shop/products/<id:\d+>/cart' => 'shop/cart/add',
        'shop/products/<id:\d+>/wish' => 'shop/wishlist/add',

        'GET shop/cart' => 'shop/cart/index',
        'DELETE shop/cart' => 'shop/cart/clear',
        'PUT shop/cart/<id:\d+>/quantity' => 'shop/cart/quantity',
        'DELETE shop/cart/<id:\d+>' => 'shop/cart/delete',
        'shop/cart/checkout' => 'shop/checkout/index',

        'GET shop/wishlist' => 'shop/wishlist/index',
        'DELETE shop/wishlist/<id:\d+>' => 'shop/wishlist/delete',
    ],
];
