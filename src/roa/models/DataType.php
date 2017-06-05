<?php

namespace tecnocen\formgenerato\roa\models;

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
    protected function slugConfig()
    {
        return ['resourceName' => 'data-type'];
    }
}
