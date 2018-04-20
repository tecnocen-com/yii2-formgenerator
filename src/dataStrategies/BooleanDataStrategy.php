<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class BooleanDataStrategy implements DataStrategy
{
    public function __construct()
    {
    }

    public function load(SolicitudeValue $model, $data, $formName = null)
    {
        $scope = $formName === null ? $model->formName() : $formName;
        if (empty($data)) {
            return false;
        }

        if ($scope === '') {
            if (isset($data['raw'])) {
                $model->raw = $data['raw'];
                return true;
            }

            return false;
        } elseif (isset($data[$scope]['raw'])) {
            $model->raw = $data[$scope]['raw'];
            return true;
        }

        return false;
    }

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
