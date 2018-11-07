<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;

class DecimalDataStrategy extends BaseDataStrategy
{
    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        if (null === $value) {
            return null;
        }

        return (float)$value;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        if (null === $raw) {
            return null;
        }

        return (float)$value;
    }
}
