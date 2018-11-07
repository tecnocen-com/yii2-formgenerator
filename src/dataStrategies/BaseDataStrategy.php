<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

abstract class BaseDataStrategy implements DataStrategy
{
    /**
     * @inheritdoc
     */
    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function load(
        SolicitudeValue $model,
        ?array $data,
        ?string $formName = null
    ): bool {
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

    /**
     * @inheritdoc
     */
    public function erase($raw)
    {
    }
}
