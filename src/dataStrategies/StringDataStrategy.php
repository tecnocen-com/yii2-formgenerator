<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class StringDataStrategy extends BaseDataStrategy
{
    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        return $value;
    }
}
