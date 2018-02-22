<?php

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/test.php',
    [
        'id' => 'yii2-formgenerator-demo',
        'bootstrap' => ['debug'],
        'modules' => [
            'debug' => [
                'class' => yii\debug\Module::class,
            ],
        ],
    ]
);
