<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\DataType;

class DataTypeFixture extends \yii\test\ActiveFixture
{
    public $modelClass = DataType::class;

    public $dataFile = __DIR__ . '/data/DataType.php';
}
