<?php

$now = new yii\db\Expression('now()');

return [
    [
        'form_id' => 1,
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
];
