<?php

use tecnocen\formgenerator\roa\modules\Version as FormgeneratorVersion;
use tecnocen\roa\controllers\ProfileResource;
use tecnocen\roa\hal\JsonResponseFormatter;
use yii\web\Response;

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/common.php',
    [
        'id' => 'yii2-formgenerator-tests',
        'bootstrap' => ['api'],
        'modules' => [
            'api' => [
                'class' => tecnocen\roa\modules\ApiContainer::class,
                'identityClass' => app\models\User::class,
                'versions' => [
                    'f1' => [
                        'class' => FormgeneratorVersion::class,
                    ],
                ],
            ],
            'rmdb' => [
                'class' => tecnocen\rmdb\Module::class,
            ],
        ],
        'components' => [
            'mailer' => [
                'useFileTransport' => true,
            ],
            'user' => ['identityClass' => app\models\User::class],
            'urlManager' => [
                'showScriptName' => true,
                'enablePrettyUrl' => true,
            ],
            'request' => [
                'cookieValidationKey' => 'test',
                'enableCsrfValidation' => false,
            ],
        ],
        'params' => [],
    ]
);
