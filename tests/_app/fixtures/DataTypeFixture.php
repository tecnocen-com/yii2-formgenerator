<?php

namespace app\fixtures;

use tecnocen\formgenerator\models\DataType;

/**
 * Fixture to load default data types
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class DataTypeFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = DataType::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/data_type.php';
}
