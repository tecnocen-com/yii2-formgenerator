<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\FieldRule;

/**
 * Fixture to load `FieldRule` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldRuleFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/FieldRule.php';

    /**
     * @inheritdoc
     */
    public $depends = [FieldFixture::class];
}
