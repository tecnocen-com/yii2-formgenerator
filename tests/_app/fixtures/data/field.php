<?php

$now = new yii\db\Expression('now()');

return [
    [
        'data_type' => 'string',
        'name' => 'name',
        'label' => 'Name(s)',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'data_type' => 'string',
        'name' => 'lastname',
        'label' => 'Last Name(s)',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'data_type' => 'string',
        'name' => 'birthdate',
        'label' => 'Date of Birth',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'data_type' => 'string',
        'name' => 'email',
        'label' => 'Email',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'data_type' => 'integer',
        'name' => 'country_id',
        'label' => 'Country',
        'service' => '/country',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
    [
        'data_type' => 'decimal',
        'name' => 'income',
        'label' => 'Income',
        'created_by' => 1,
        'created_at' => $now,
        'updated_by' => 1,
        'updated_at' => $now,
    ],
];
