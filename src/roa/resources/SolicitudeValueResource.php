<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\SolicitudeValue;
use tecnocen\formgenerator\roa\models\SolicitudeValueSimpleSearch;

/**
 * Search resource for `SolicitudeValue` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SolicitudeValueResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    public $searchClass = SolicitudeValueSimpleSearch::class;

    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
        ];
    }
}
