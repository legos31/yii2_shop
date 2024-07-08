<?php

/** @var array $params */

return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/'     => 'site/index',
        '<_a:login|logout>'     => 'auth/auth/<_a>',
        'signup' => 'auth/signup/signup',
        'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
        'request-password-reset' => 'auth/reset/request-password-reset',
        'reset-password' => 'auth/reset/reset-password/',
        'resend-verification-email' => 'auth/resend/resend-verification-email',
        'verify-email' => 'auth/resend/verify-email',
        'contact' => 'site/contact',

        'cabinet' => 'cabinet/default/index',
        'cabinet/<_c:[\w\-]+>' => 'cabinet/<_c>/index',
        'cabinet/<_c:[\w\-]+>/<id:\d+>' => 'cabinet/<_c>/view',
        'cabinet/<_c:[\w\-]+>/<_a:[\w-]+>' => 'cabinet/<_c>/<_a>',
        'cabinet/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];