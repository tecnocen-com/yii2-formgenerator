<?php

$now = new yii\db\Expression('now()');

return [
    [
        'name' => 'string',
        'label' => 'String',
        'cast' => 'stringCast',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'name' => 'integer',
        'label' => 'Integer',
        'cast' => 'integerCast',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'name' => 'float',
        'label' => 'Decimal',
        'cast' => 'floatCast',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'name' => 'boolean',
        'label' => 'Boolean',
        'cast' => 'booleanCast',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'name' => 'file',
        'label' => 'File',
        'cast' => 'fileCast',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
];
