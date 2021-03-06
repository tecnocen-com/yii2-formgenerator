<?php

return [
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@tests' => dirname(dirname(__DIR__)),
        '@tecnocen/formgenerator' => dirname(dirname(dirname(__DIR__))) . '/src',
        '@tecnocen/oauth2server' => VENDOR_DIR . '/tecnocen/yii2-oauth2-server/src',
    ],
    'components' => [
        'db' => require __DIR__ . '/db.php',
    ],
];
