<?php

use tecnocen\formgenerator\dataTypes;

$now = new yii\db\Expression('now()');


return [
    [
        'name' => 'string',
        'class' => dataTypes\StringDataType::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'integer',
        'class' => dataTypes\IntegerDataType::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'float',
        'class' => dataTypes\DecimalDataType::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'boolean',
        'class' => dataTypes\BooleanDataType::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
    [
        'name' => 'public-file',
        'class' => dataTypes\FileDataType::class,
        'created_by' => 1,
        'created_at' => $now,
    ],
];
