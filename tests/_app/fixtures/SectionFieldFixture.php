<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\SectionField;

/**
 * Fixture to load `SectionField` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SectionFieldFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = SectionField::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/SectionField.php';

    /**
     * @inheritdoc
     */
    public $depends = [FieldFixture::class, SectionFixture::class];
}
