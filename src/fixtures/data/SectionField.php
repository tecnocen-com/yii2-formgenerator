<?php

$now = new yii\db\Expression('now()');

return [
    [
        'section_id' => 1,
        'field_id' => 1,
        'position' => 1,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 2,
        'position' => 2,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 3,
        'position' => 3,
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 1,
        'field_id' => 4,
        'position' => 4,
        'label' => 'Registration e-mail',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 2,
        'field_id' => 5,
        'position' => 1,
        'label' => 'Country of residence',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'section_id' => 2,
        'field_id' => 6,
        'position' => 2,
        'label' => 'Brute Income',
        'created_by' => 1,
        'created_at' => $now
    ],
];
