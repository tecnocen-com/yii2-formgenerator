<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\SolicitudeValue;

/**
 * Fixture to load `SolicitudeValue` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SolicitudeValueFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/SolicitudeValue.php';

    /**
     * @inheritdoc
     */
    public $depends = [SolicitudeFixture::class, SectionFieldFixture::class];
}
