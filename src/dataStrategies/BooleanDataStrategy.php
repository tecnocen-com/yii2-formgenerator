<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class BooleanDataStrategy extends BaseDataStrategy
{
    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        if (null === $raw || '' === $raw) {
            return null;
        }

        if (0 == $raw) {
            return 0;
        }

        return 1;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        if (null === $raw) {
            return null;
        }

        if (0 == $raw) {
            return false;
        }

        return true;
    }
}
