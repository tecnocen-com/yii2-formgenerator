<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling Form records.
 */
class DataType extends \tecnocen\formgenerator\models\DataType
    implements Linkable
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
        return ['resourceName' => 'data-type'];
    }
}
