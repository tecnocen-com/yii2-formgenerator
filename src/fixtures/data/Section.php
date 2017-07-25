<?php

$now = new yii\db\Expression('now()');

return [
    [
        'form_id' => 1,
        'position' => 1,
        'name' => 'personal',
        'label' => 'Personal Information',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'form_id' => 1,
        'position' => 2,
        'name' => 'professional',
        'label' => 'Profesional Information',
        'created_by' => 1,
        'created_at' => $now
    ],
];
