<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling FieldRule records.
 */
class FieldRuleProperty extends \tecnocen\formgenerator\models\FieldRuleProperty
    implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'resourceName' => 'property',
            'parentSlugRelation' => 'rule',
        ];
    }
}
