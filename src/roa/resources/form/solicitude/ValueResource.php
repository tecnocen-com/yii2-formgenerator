<?php

namespace tecnocen\formgenerator\roa\resources\form\solicitude;

use Yii;
use tecnocen\formgenerator\roa\models\SolicitudeValue;

/**
 * CRUD resource for `SolicitudeValue` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class ValueResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $idAttribute = 'field_id';

    /**
     * @inheritdoc
     */
    public $modelClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->andWhere([
            'solicitude_id' => Yii::$app->request
                ->getQueryParam('solicitude_id'),
        ])->andFilterWhere([
            'section_id' => Yii::$app->request
                ->getQueryParam('section_id'),
        ]);
    }
}
