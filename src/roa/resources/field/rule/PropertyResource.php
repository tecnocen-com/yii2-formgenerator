<?php

namespace tecnocen\formgenerator\roa\resources\field\rule;

use Yii;
use tecnocen\formgenerator\roa\models\FieldRuleProperty;

/**
 * CRUD resource for `FieldRuleProperty` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class PropertyResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRuleProperty::class;

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->andWhere([
            'rule_id' => Yii::$app->request->getQueryParam('rule_id'),
        ]);
    }
}
