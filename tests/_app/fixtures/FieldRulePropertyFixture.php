<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\FieldRuleProperty;

/**
 * Fixture to load `FieldRuleProperty` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldRulePropertyFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRuleProperty::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/FieldRuleProperty.php';

    /**
     * @inheritdoc
     */
    public $depends = [FieldRuleFixture::class];
}
