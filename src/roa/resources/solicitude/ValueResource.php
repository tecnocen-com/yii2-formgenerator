<?php

namespace tecnocen\formgenerator\roa\resources\solicitude;

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
    public $modelClass = SolicitudeValue::class;
}
