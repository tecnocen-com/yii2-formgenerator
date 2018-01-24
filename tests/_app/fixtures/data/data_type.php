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
];
