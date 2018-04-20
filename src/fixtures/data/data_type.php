<?php

use tecnocen\formgenerator\dataStrategies;

$now = new yii\db\Expression('now()');


return [
    [
        'name' => 'string',
        'class' => dataStrategies\StringDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'integer',
        'class' => dataStrategies\IntegerDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'decimal',
        'class' => dataStrategies\DecimalDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'boolean',
        'class' => dataStrategies\BooleanDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'public-file',
        'class' => dataStrategies\FileDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
];
