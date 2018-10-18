<?php

namespace tecnocen\formgenerator\roa\resources\form;

use Yii;
use tecnocen\formgenerator\roa\models\Solicitude;
use tecnocen\formgenerator\roa\models\SolicitudeSearch;

/**
 * CRUD resource for `Solicitude` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SolicitudeResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public $searchClass = SolicitudeSearch::class;

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->andWhere([
            'form_id' => Yii::$app->request->getQueryParam('form_id'),
        ]);
    }
}
