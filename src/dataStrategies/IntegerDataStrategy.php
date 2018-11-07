<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class IntegerDataStrategy extends BaseDataStrategy
{
    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        if (null === $raw) {
            return null;
        }

        return (int)$value;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        if (null === $raw) {
            return null;
        }

        return (int)$raw;
    }
}
