<?php

namespace tecnocen\formgenerator\roa\resources\form;

use Yii;
use tecnocen\formgenerator\roa\models\Solicitude;
use tecnocen\formgenerator\roa\models\SolicitudeSearch;

/**
 * CRUD resource for `Solicitude` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SolicitudeResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public $filterParams = ['form_id'];
}
