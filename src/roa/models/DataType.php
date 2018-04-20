<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\web\Linkable;

/**
 * ROA contract handling Form records.
 *
 * @method void checkAccess(array $params)
 */
class DataType extends base\DataType implements
    Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'resourceName' => 'data-type',
            'idAttribute' => 'name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['fields'];
    }
}
