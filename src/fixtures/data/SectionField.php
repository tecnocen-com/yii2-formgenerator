<?php

$now = new yii\db\Expression('now()');

return [
    [
        'section_id' => 1,
        'field_id' => 1,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 2,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 3,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 4,
        'label' => 'Registration e-mail',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 2,
        'field_id' => 5,
        'label' => 'Country of residence',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 2,
        'field_id' => 6,
        'label' => 'Brute Income',
        'created_by' => 1,
        'created_at' => $now
    ],
];
