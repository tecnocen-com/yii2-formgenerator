<?php

use yii\db\Expression as DbExpression;

return [
    [
        'name' => 'string',
        'cast' => 'stringCast',
        'created_by' => 1,
        'created_at' => new DbExpression('now()'),
    ],
    [
        'name' => 'integer',
        'cast' => 'integerCast',
        'created_by' => 1,
        'created_at' => new DbExpression('now()'),
    ],
    [
        'name' => 'float',
        'cast' => 'floatCast',
        'created_by' => 1,
        'created_at' => new DbExpression('now()'),
    ],
    [
        'name' => 'boolean',
        'cast' => 'booleanCast',
        'created_by' => 1,
        'created_at' => new DbExpression('now()'),
    ],
    [
        'name' => 'file',
        'cast' => 'fileCast',
        'created_by' => 1,
        'created_at' => new DbExpression('now()'),
    ],
];
