<?php

namespace tecnocen\formgenerator\roa\resources\field;

use Yii;
use tecnocen\formgenerator\roa\models\FieldRule;

/**
 * CRUD resource for `FieldRule` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class RuleResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->with(['properties'])->andWhere([
            'field_id' => Yii::$app->request->getQueryParam('field_id'),
        ]);            
    }
}
