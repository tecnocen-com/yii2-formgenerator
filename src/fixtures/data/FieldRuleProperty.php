<?php

$now = new yii\db\Expression('now()');

return [
    [
        'rule_id' => 3,
        'property' => 'min',
        'value' => 6,
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'rule_id' => 6,
        'property' => 'min',
        'value' => 6,
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'rule_id' => 9,
        'property' => 'format',
        'value' => 'yyyy-MM-dd',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'rule_id' => 14,
        'property' => 'min',
        'value' => 1,
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'rule_id' => 15,
        'property' => 'min',
        'value' => 0,
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
];
