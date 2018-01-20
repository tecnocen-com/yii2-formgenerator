<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\DataType;
use tecnocen\formgenerator\roa\models\DataTypeSearch;

/**
 * CRUD resource for `DataType` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class DataTypeResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = DataType::class;

    /**
     * @inheritdoc
     */
    public $searchClass = DataTypeSearch::class;
}
