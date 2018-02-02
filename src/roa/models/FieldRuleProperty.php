<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use yii\web\Linkable;
use yii\web\NotFoundHttpException;

/**
 * ROA contract handling FieldRule records.
 *
 * @method void checkAccess(array $params)
 */
class FieldRuleProperty extends base\FieldRuleProperty implements Linkable
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
    public function extraFields()
    {
        return ['rule'];
    }
}
