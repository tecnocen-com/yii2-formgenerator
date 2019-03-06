<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\DataTypeTranslation;

/**
 * Fixture to load default data types
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class DataTypeTranslationFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = DataTypeTranslation::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/data_type_translation.php';
}
