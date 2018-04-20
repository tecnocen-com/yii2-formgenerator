<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class DecimalDataStrategy implements DataStrategy
{
    public function __construct()
    {
    }

    public function load(SolicitudeValue $model, $data, $formName = null)
    {
        if ('' === $formName) {
            return ArrayHelper::getValue($data, 'raw');
        }
        if ($formName === null) {
            $formName = $model->formName();
        }
        return ArrayHelper::getValue($data, $formName . '.raw');
    }

    public function store(SolicitudeValue $model, $value)
    {
        if (null === $value) {
            return null;
        }

        return (float)$value;
    }

    public function read($raw)
    {
        if (null === $raw) {
            return null;
        }

        return (float)$value;
    }
}
