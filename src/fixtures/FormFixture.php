<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\Form;

/**
 * Fixture to load `Form` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FormFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = Form::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/Form.php';
}
