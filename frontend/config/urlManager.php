<?php

/** @var array $params */

return [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '/'     => 'site/index',
        '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
    ],
];