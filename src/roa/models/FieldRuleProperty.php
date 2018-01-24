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
    protected $ruleClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => 'property',
            'resourceName' => 'property',
            'parentSlugRelation' => 'rule',
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['rule'];
    }
}
