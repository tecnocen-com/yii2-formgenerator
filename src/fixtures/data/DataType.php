<?php

$now = new yii\db\Expression('now()');

return [
    [
        'name' => 'string',
        'cast' => 'stringCast',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'name' => 'integer',
        'cast' => 'integerCast',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'name' => 'float',
        'cast' => 'floatCast',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'name' => 'boolean',
        'cast' => 'booleanCast',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'name' => 'file',
        'cast' => 'fileCast',
        'created_by' => 1,
        'created_at' => $now
    ],
];
