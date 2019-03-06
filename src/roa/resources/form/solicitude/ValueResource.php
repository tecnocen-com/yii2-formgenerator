<?php

namespace tecnocen\formgenerator\roa\resources\form\solicitude;

use Yii;
use tecnocen\formgenerator\roa\models\SolicitudeValue;
use tecnocen\formgenerator\roa\models\SolicitudeValueSearch;

/**
 * CRUD resource for `SolicitudeValue` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class ValueResource extends \tecnocen\roa\controllers\Resource
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
    public $filterParams = ['solicitude_id', 'section_id'];
}
