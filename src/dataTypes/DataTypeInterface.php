<?php

namespace tecnocen\formgenerator\dataTypes;

use yii\base\Model;

interface DataTypeInterface
{
    public function __construct();

    public function load(Model $model, $data, $formName = null);

    public function store(Model $model, $value);

    public function read($raw);
}
