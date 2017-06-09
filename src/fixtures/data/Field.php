<?php

$now = new yii\db\Expression('now()');

return [
    [
        'data_type_id' => 1,
        'name' => 'name',
        'label' => 'Name(s)',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'data_type_id' => 1,
        'name' => 'lastname',
        'label' => 'Last Name(s)',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'data_type_id' => 1,
        'name' => 'birthdate',
        'label' => 'Date of Birth',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'data_type_id' => 1,
        'name' => 'email',
        'label' => 'Email',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'data_type_id' => 2,
        'name' => 'country_id',
        'label' => 'Country',
        'service' => '/country',
        'created_by' => 1,
        'created_at' => $now
    ],
    [
        'data_type_id' => 3,
        'name' => 'income',
        'label' => 'Income',
        'created_by' => 1,
        'created_at' => $now
    ],
];
