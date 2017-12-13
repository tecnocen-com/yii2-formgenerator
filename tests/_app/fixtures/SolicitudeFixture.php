<?php

namespace app\fixtures;

use tecnocen\formgenerator\models\Solicitude;

/**
 * Fixture to load `Solicitude` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SolicitudeFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/solicitude.php';

    /**
     * @inhertidoc
     */
    public $depends = [FormFixture::class];
}
