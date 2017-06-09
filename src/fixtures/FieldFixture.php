<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\Field;

/**
 * Fixture to load `Field` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = Field::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/Field.php';

    /**
     * @inheritdoc
     */
    public $depends = [DataTypeFixture::class];
}
