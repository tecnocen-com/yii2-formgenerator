<?php

namespace tecnocen\formgenerator\roa\resources\field\rule;

use tecnocen\formgenerator\roa\models\FieldRuleProperty;
use tecnocen\formgenerator\roa\models\FieldRulePropertySearch;
use Yii;

/**
 * CRUD resource for `FieldRuleProperty` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class PropertyResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $idAttribute = 'property';

    /**
     * @inheritdoc
     */
    public $modelClass = FieldRuleProperty::class;

    /**
     * @inheritdoc
     */
    public $searchClass = FieldRulePropertySearch::class;

    /**
     * @inheritdoc
     */
    public $filterParams = ['field_id', 'rule_id'];

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->innerJoinWith(['rule']);
    }
}
