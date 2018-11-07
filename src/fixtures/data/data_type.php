<?php

use tecnocen\formgenerator\dataStrategies;

$now = new yii\db\Expression('now()');

return [
    [
        'name' => 'string',
        'strategy' => dataStrategies\StringDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'integer',
        'strategy' => dataStrategies\IntegerDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'decimal',
        'strategy' => dataStrategies\DecimalDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'boolean',
        'strategy' => dataStrategies\BooleanDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'public-file',
        'strategy' => dataStrategies\FileDataStrategy::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
];
