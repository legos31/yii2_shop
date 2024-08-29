<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'user.rememberMeDuration' => 3600 * 24 * 30,
    'cookieDomain' => '.shop.loc',
    'frontendHostInfo' => 'http://shop.loc',
    'backendHostInfo' => 'http://admin.shop.loc',
    'staticHostInfo' => 'http://localhost:8080',
    'staticPath' => dirname(__DIR__, 2) . '/static',
    'mailChimpKey' => '',
    'mailChimpListId' => '',
    'smsRuKey' => '',
];
